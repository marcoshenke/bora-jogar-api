class PlayerSerializer < ActiveModel::Serializer
  attributes :id, :full_name, :city, :avatar, :bio, :user_id, :created_at, :updated_at

  attribute :profile do
    if object.profile.present?
      PlayerProfileSerializer.new(object.profile)
    else
      nil
    end
  end

  attribute :availabilities do
    object.availabilities.map do |a|
      {
        id: a.id,
        week_day_id: a.week_day_id,
        week_day_name: a.week_day.name,
        start_time: a.start_time.strftime('%H:%M'),
        end_time: a.end_time.strftime('%H:%M')
      }
    end
  end
end