class CreatePlayerAvailabilities < ActiveRecord::Migration[7.1]
  def change
    create_table :player_availabilities do |t|
      t.references :player, null: false, foreign_key: true
      t.references :week_day, null: false, foreign_key: true
      t.time :start_time, null: false
      t.time :end_time, null: false

      t.timestamps
    end
  end
end