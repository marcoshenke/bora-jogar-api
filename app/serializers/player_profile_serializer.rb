class PlayerProfileSerializer < ActiveModel::Serializer
  attributes :id, :player_id, :favorite_position, :dominant_foot, :playing_style, :skill_level, :playing_frequency, :created_at, :updated_at

  attribute :positions do
    object.positions.map { |p| { id: p.id, name: p.name } }
  end
end