class CreatePositions < ActiveRecord::Migration[7.1]
  def change
    create_table :positions do |t|
      t.references :sport, null: false, foreign_key: true
      t.string :name, null: false

      t.timestamps
    end
  end
end