class PlayerAvailability < ApplicationRecord
  belongs_to :player

  validates :player, presence: true
  validates :week_day, presence: true

  enum :preferred_time {
    morning: 0,
    afternoon: 1,
    evening: 2
  }

	enum :week_day {
  sunday: 0,
  monday: 1,
  tuesday: 2,
  wednesday: 3,
  thursday: 4,
  friday: 5,
  saturday: 6
	}
end
