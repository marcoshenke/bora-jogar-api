class User < ApplicationRecord
  devise :database_authenticatable, :registerable,
         :recoverable, :rememberable, :validatable,
         :jwt_authenticatable, jwt_revocation_strategy: JwtDenylist

  has_one :player, dependent: :destroy

  validates :name, presence: true
  validates :email, presence: true, uniqueness: true

  def generate_jwt_token
    JWT.encode(
      {
        sub: id,
        email: email,
        iat: Time.now.to_i,
        exp: 1.week.from_now.to_i
      },
      ENV.fetch('DEVISE_JWT_SECRET_KEY', 'default_secret_key_change_in_production'),
      'HS256'
    )
  end
end