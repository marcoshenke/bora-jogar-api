class WeekDay < ApplicationRecord
  has_many :player_availabilities, dependent: :destroy

  validates :name, presence: true, uniqueness: true
end