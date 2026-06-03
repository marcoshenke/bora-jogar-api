module Api
  module V1
    module Users
      class RegistrationsController < Devise::RegistrationsController
        respond_to :json

        def create
          build_resource(sign_up_params)

          if resource.save
            token = resource.generate_jwt_token
            render json: {
              message: 'User registered successfully!',
              user: UserSerializer.new(resource),
              token: token
            }, status: :created
          else
            render json: {
              message: resource.errors.full_messages.join(', ')
            }, status: :unprocessable_entity
          end
        end

        private

        def sign_up_params
          params.require(:user).permit(:name, :email, :password, :password_confirmation)
        end

        def respond_with(resource, _opts = {})
        end
      end
    end
  end
end