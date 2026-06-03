class PlayerProfile < ApplicationRecord
  belongs_to :player
  has_and_belongs_to_many :positions

  validates :player, presence: true
end