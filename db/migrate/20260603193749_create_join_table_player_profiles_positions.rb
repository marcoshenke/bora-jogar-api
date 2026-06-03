class CreateJoinTablePlayerProfilesPositions < ActiveRecord::Migration[7.1]
  def change
    create_join_table :player_profiles, :positions do |t|
      # t.index [:player_profile_id, :position_id]
      # t.index [:position_id, :player_profile_id]
    end
  end
end
