# Bora Jogar API - Ruby on Rails

A REST API for the "Bora Jogar" sports platform, migrated from Laravel (PHP) to Ruby on Rails 7.1 with PostgreSQL.

## Overview

This project replaces the previous Laravel API with a Ruby on Rails implementation, maintaining all original functionality while improving code structure and maintainability.

## Tech Stack

- **Framework**: Ruby on Rails 7.1 (API mode)
- **Database**: PostgreSQL 15
- **Authentication**: Devise + JWT (custom implementation)
- **Container**: Docker & Docker Compose
- **Ruby Version**: 3.3.11

## Project Structure

```
bora-jogar-api/
├── app/
│   ├── controllers/
│   │   ├── api/v1/          # API version 1 controllers
│   │   │   ├── players_controller.rb
│   │   │   ├── player_profiles_controller.rb
│   │   │   ├── player_availabilities_controller.rb
│   │   │   ├── sports_controller.rb
│   │   │   ├── positions_controller.rb
│   │   │   └── users/       # Devise controllers
│   │   │       ├── sessions_controller.rb
│   │   │       ├── registrations_controller.rb
│   │   │       └── passwords_controller.rb
│   │   └── application_controller.rb
│   ├── models/             # ActiveRecord models
│   │   ├── user.rb
│   │   ├── player.rb
│   │   ├── player_profile.rb
│   │   ├── player_availability.rb
│   │   ├── sport.rb
│   │   ├── position.rb
│   │   ├── week_day.rb
│   │   └── jwt_denylist.rb
│   └── serializers/        # JSON serialization
├── config/
│   ├── routes.rb           # API routes
│   ├── database.yml        # PostgreSQL config
│   └── environments/       # Rails environments
├── db/
│   ├── migrations/         # Database migrations
│   └── seeds.rb           # Initial data
├── docker-compose.yml     # Docker services
├── Dockerfile            # Rails container
└── Gemfile               # Ruby dependencies
```

## Getting Started

### Prerequisites

- Docker and Docker Compose installed
- PostgreSQL (provided via Docker)

### Running the Application

1. **Start the containers:**
   ```bash
   docker compose up -d --build
   ```

2. **Run migrations:**
   ```bash
   docker compose exec web bundle exec rails db:create db:migrate
   ```

3. **Seed initial data:**
   ```bash
   docker compose exec web bundle exec rails db:seed
   ```

4. **Access the API:**
   - Base URL: `http://localhost:3000`
   - Health check: `GET /up`

## API Endpoints

### Authentication
| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/v1/users` | Register new user |
| POST | `/api/v1/users/sign_in` | Login |
| DELETE | `/api/v1/users/sign_out` | Logout |
| POST | `/api/v1/users/password` | Forgot password |
| PUT | `/api/v1/users/password` | Reset password |

### Players
| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/v1/players` | Create player profile |
| GET | `/api/v1/players` | Get current player |
| PUT | `/api/v1/players` | Update player |

### Player Profiles
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/v1/players/profile` | Get profile |
| PUT | `/api/v1/players/profile` | Update profile |

### Player Availabilities
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/v1/players/availabilities` | List availabilities |
| POST | `/api/v1/players/availabilities` | Create availability |
| DELETE | `/api/v1/players/availabilities/:id` | Delete availability |

### Reference Data
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/v1/sports` | List sports |
| GET | `/api/v1/sports/:id` | Get sport with positions |
| GET | `/api/v1/positions` | List positions |
| GET | `/api/v1/week_days` | List week days |

### Authentication via JWT

Include JWT token in the Authorization header:
```
Authorization: Bearer <your_jwt_token>
```

## Example Usage

### Register a new user:
```bash
curl -X POST http://localhost:3000/api/v1/users \
  -H "Content-Type: application/json" \
  -d '{"user": {"name": "John Doe", "email": "john@example.com", "password": "password123", "password_confirmation": "password123"}}'
```

### Login:
```bash
curl -X POST http://localhost:3000/api/v1/users/sign_in \
  -H "Content-Type: application/json" \
  -d '{"user": {"email": "john@example.com", "password": "password123"}}'
```

### Create Player (with JWT):
```bash
curl -X POST http://localhost:3000/api/v1/players \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer <token>" \
  -d '{"player": {"full_name": "John Doe", "city": "São Paulo"}}'
```

## Models

### User
- `name` (string)
- `email` (string, unique)
- `encrypted_password` (string)
- Associations: has_one :player

### Player
- `full_name` (string)
- `city` (string)
- `avatar` (string)
- `bio` (text)
- `user_id` (references User)
- Associations: has_one :profile, has_many :availabilities

### PlayerProfile
- `favorite_position` (string)
- `dominant_foot` (string: right, left, both)
- `playing_style` (string: fun, competitive, technical, social)
- `skill_level` (string: beginner, intermediate, regular, star)
- `playing_frequency` (string: weekly, occasionally, rarely)
- Associations: belongs_to :player, has_and_belongs_to_many :positions

### PlayerAvailability
- `week_day_id` (references WeekDay)
- `start_time` (time)
- `end_time` (time)
- Associations: belongs_to :player, belongs_to :week_day

### Sport & Position
- Sport has_many :positions
- Position belongs_to :sport

### WeekDay
- `name` (string: Segunda-feira, Terça-feira, etc.)

## Configuration

### Environment Variables
Create a `.env` file or use Docker Compose environment:
- `RAILS_ENV`: development/test/production
- `DB_HOST`: PostgreSQL host
- `DB_USERNAME`: PostgreSQL user
- `DB_PASSWORD`: PostgreSQL password
- `DEVISE_JWT_SECRET_KEY`: JWT signing secret

## Next Steps

### High Priority
1. **Fix Session/Logout**: Implement proper JWT logout by adding token to denylist
2. **Password Recovery**: Complete forgot/reset password functionality with email
3. **Email Integration**: Set up ActionMailer for password reset emails
4. **Input Validation**: Add more robust request validation with specific error messages

### Medium Priority
1. **Profile Image Upload**: Implement avatar upload functionality (was present in Laravel)
2. **API Versioning**: Add v2 endpoint structure for future improvements
3. **Rate Limiting**: Add request throttling to prevent abuse
4. **API Documentation**: Add Swagger/OpenAPI documentation

### Low Priority
1. **Testing**: Add RSpec test suite
2. **Caching**: Implement Redis caching for frequently accessed data
3. **Background Jobs**: Add Sidekiq for async operations (notifications, emails)
4. **Webhooks**: Add webhook support for external integrations
5. **Real-time**: Add ActionCable for real-time features

### Features from Original Laravel App
1. Sports and Positions data management
2. Player profile preferences (foot, style, skill level)
3. Weekly availability scheduling
4. Multi-sport support (Futebol, Futsal, Vôlei, etc.)

## Known Issues / Limitations

1. **JWT Logout**: Currently tokens don't expire automatically - need to implement token blacklisting properly
2. **Email**: Password reset emails not fully implemented
3. **File Upload**: Avatar upload needs to be reimplemented
4. **Confirmable**: Email confirmation disabled for simplicity

## License

This project is for educational and development purposes.