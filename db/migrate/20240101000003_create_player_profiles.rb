class CreatePlayerProfiles < ActiveRecord::Migration[7.1]
  def change
    create_table :player_profiles do |t|
      t.references :player, null: false, foreign_key: true
      t.string :favorite_position
      t.string :dominant_foot
      t.string :playing_style
      t.string :skill_level
      t.string :playing_frequency

      t.timestamps
    end
  end
end