module Api
  module V1
    module Users
      class PasswordsController < Devise::PasswordsController
        respond_to :json

        def create
          self.resource = resource_class.send_reset_password_instructions(resource_params)

          if successfully_sent?(resource)
            render json: {
              message: 'Password reset instructions sent to your email'
            }, status: :ok
          else
            render json: {
              message: 'Email not found'
            }, status: :not_found
          end
        end

        def update
          self.resource = resource_class.reset_password_by_token(resource_params)

          if resource.errors.empty?
            resource.assign_attributes(reset_password_token: nil, reset_password_sent_at: nil)
            resource.save!
            render json: {
              message: 'Password reset successfully'
            }, status: :ok
          else
            render json: {
              message: resource.errors.full_messages.join(', ')
            }, status: :unprocessable_entity
          end
        end
      end
    end
  end
end