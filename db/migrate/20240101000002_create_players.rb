class CreatePlayers < ActiveRecord::Migration[7.1]
  def change
    create_table :players do |t|
      t.references :user, null: false, foreign_key: true
      t.string :full_name, null: false
      t.string :city, null: false
      t.string :avatar
      t.text :bio

      t.timestamps
    end
  end
end