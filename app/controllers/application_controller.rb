class ApplicationController < ActionController::API
  include ActionController::Cookies
  include Devise::Controllers::Helpers

  before_action :configure_permitted_parameters, if: :devise_controller?

  def current_user
    @current_user ||= load_user_from_token
  end

  private

  def load_user_from_token
    token = request.headers['Authorization']&.split(' ')&.last
    return nil if token.nil?

    begin
      decoded = JWT.decode(
        token,
        ENV.fetch('DEVISE_JWT_SECRET_KEY', 'default_secret_key_change_in_production'),
        true,
        algorithm: 'HS256'
      )
      user_id = decoded.first['sub']
      User.find_by(id: user_id)
    rescue JWT::DecodeError, JWT::ExpiredSignature
      nil
    end
  end

  protected

  def configure_permitted_parameters
    devise_parameter_sanitizer.permit(:sign_up, keys: [:name])
    devise_parameter_sanitizer.permit(:account_update, keys: [:name])
  end

  def render_success(data = nil, message = nil, status = :ok)
    render json: {
      success: true,
      message: message,
      data: data
    }, status: status
  end

  def render_error(message, status = :unprocessable_entity)
    render json: {
      success: false,
      message: message
    }, status: status
  end
end