class Position < ApplicationRecord
  belongs_to :sport
  has_and_belongs_to_many :player_profiles

  validates :name, presence: true
  validates :sport, presence: true
end