class CreatePlayerAvailabilities < ActiveRecord::Migration[7.1]
  def change
    create_table :player_availabilities do |t|
      t.references :player, null: false, foreign_key: true
      t.integer :week_day, null: false
      t.time :start_time, null: false
      t.time :end_time, null: false

      t.timestamps
    end

    add_index :player_availabilities,
      [:player_id, :week_day]
  end
end
