Devise.setup do |config|
  config.navigational_formats = []
end

ActionController::Parameters.permit_all_parameters = true