class CreatePlayerPosition < ActiveRecord::Migration[7.1]
  def change
    create_table :player_positions do |t|
      t.references :player, null: false, foreign_key: true
      t.references :position, null: false, foreign_key: true

      t.timestamps
    end
  end
end
