# Laravel-Pad

### API

#### Endpoints

- `GET /api/status/ping` - Returns `message: pong`
- `POST /api/status/foo` - Returns `message: bar`

#### Workdays

- `GET /api/workday/{country}/{date}`
  - PARAMS:
    - `country` - Country code (e.g. `CZE`)
    - `date` - Date in `Y-m-d` format

#### Task duration

- `GET /api/task-duration/expected-duration`
  - QUERY:
    - *`taskStart` - DateTime in `Y-m-d\TH:i:s`  format
    - *`duration` - integer, duration in minutes
    - *`workingHourStart` - Time in `H:i:s` format
    - *`workingHourEnd` - Time in `H:i:s` format
    - `workingDaysOnly` - boolean, uses only working days, default `false`
