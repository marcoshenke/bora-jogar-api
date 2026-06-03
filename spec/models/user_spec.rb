require 'rails_helper'

RSpec.describe User, type: :model do
    describe "Validations" do
        it { should validate_presence_of(:name) }
        it { should validate_presence_of(:email) }
    end

    describe "Relationships" do
        it { should have_one(:player) }
    end

    describe "Methods" do
        it "returns a valid JWT token" do
            user = User.new(name: 'Ronaldinho', email: 'ronaldinho@email.com')
            token = user.generate_jwt_token
            secret = ENV.fetch('DEVISE_JWT_SECRET_KEY', 'default_secret_key_change_in_production')
            payload, header = JWT.decode(token, secret, true, algorithms: ["HS256"])

            expect(token).to be_a(String)
            expect(header["alg"]).to eq("HS256")
            expect(payload["email"]).to eq(user.email)
            expect(payload["sub"]).to eq(user.id)
          end
    end
end
