class JwtDenylist < ApplicationRecord
  include Devise::JWT::RevocationStrategies::Denylist

  self.table_name = 'jwt_denylist'

  validates :jti, presence: true, uniqueness: true

  def self.jti_revoked?(jti)
    where(jti: jti).exists?
  end
end