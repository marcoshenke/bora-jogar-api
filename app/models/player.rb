class Player < ApplicationRecord
  belongs_to :user
  has_one :profile, class_name: 'PlayerProfile', dependent: :destroy
  has_many :availabilities, class_name: 'PlayerAvailability', dependent: :destroy

  validates :full_name, presence: true
  validates :city, presence: true
end