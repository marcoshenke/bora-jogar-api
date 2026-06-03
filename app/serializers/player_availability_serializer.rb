class PlayerAvailabilitySerializer < ActiveModel::Serializer
  attributes :id, :player_id, :week_day_id, :start_time, :end_time, :created_at, :updated_at

  attribute :week_day_name do
    object.week_day.name
  end
end