class CreatePlayerProfilePositions < ActiveRecord::Migration[7.1]
  def change
    create_table :player_profile_positions do |t|
      t.references :player_profile, null: false, foreign_key: true
      t.references :position, null: false, foreign_key: true

      t.timestamps
    end
  end
end