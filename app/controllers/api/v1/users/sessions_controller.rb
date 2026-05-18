module Api
  module V1
    module Users
      class SessionsController < Devise::SessionsController
        respond_to :json

        private

        def respond_with(resource, _opts = {})
          token = resource.generate_jwt_token
          render json: {
            user: UserSerializer.new(resource),
            token: token
          }, status: :ok
        end

        def respond_to_on_destroy
          render json: { message: 'Signed out successfully' }, status: :ok
        end
      end
    end
  end
end