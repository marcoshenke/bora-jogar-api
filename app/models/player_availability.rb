class PlayerAvailability < ApplicationRecord
  belongs_to :player
  belongs_to :week_day

  validates :player, presence: true
  validates :week_day, presence: true
  validates :start_time, presence: true
  validates :end_time, presence: true
end