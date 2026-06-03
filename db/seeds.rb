WeekDay.find_or_create_by!(name: 'Segunda-feira')
WeekDay.find_or_create_by!(name: 'Terça-feira')
WeekDay.find_or_create_by!(name: 'Quarta-feira')
WeekDay.find_or_create_by!(name: 'Quinta-feira')
WeekDay.find_or_create_by!(name: 'Sexta-feira')
WeekDay.find_or_create_by!(name: 'Sábado')
WeekDay.find_or_create_by!(name: 'Domingo')

sport_futebol = Sport.find_or_create_by!(name: 'Futebol')
sport_futebol_field = Sport.find_or_create_by!(name: 'Futsal')
sport_volei = Sport.find_or_create_by!(name: 'Vôlei')

Position.find_or_create_by!(name: 'Goleiro', sport: sport_futebol)
Position.find_or_create_by!(name: 'Lateral Direito', sport: sport_futebol)
Position.find_or_create_by!(name: 'Zagueiro', sport: sport_futebol)
Position.find_or_create_by!(name: 'Lateral Esquerdo', sport: sport_futebol)
Position.find_or_create_by!(name: 'Volante', sport: sport_futebol)
Position.find_or_create_by!(name: 'Meia', sport: sport_futebol)
Position.find_or_create_by!(name: 'Atacante', sport: sport_futebol)

puts 'Seeds created successfully!'