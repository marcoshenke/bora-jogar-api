require 'rails_helper'

RSpec.describe PlayerProfile, type: :model do
    describe "Validations" do
        it { should validate_presence_of(:player) }
    end

    describe "Relationships" do
        it { should belong_to(:player) }
        it { should have_and_belong_to_many(:positions) }
    end
end
