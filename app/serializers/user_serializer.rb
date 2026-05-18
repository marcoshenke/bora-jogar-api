class UserSerializer < ActiveModel::Serializer
  attributes :id, :name, :email, :created_at, :updated_at

  attribute :player do
    if object.player.present?
      PlayerSerializer.new(object.player)
    else
      nil
    end
  end
end