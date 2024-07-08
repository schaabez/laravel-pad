# Laravel-Pad

### API

#### Endpoints

- `GET /api/status/ping`
    - Returns:
      - type: `json`
      - `message: pong`
- `POST /api/status/foo`
    - Returns
      - type: `json`
      - `message: bar`

#### Workdays

- `GET /api/workday/{country}/{date}`
  - PARAMS:
    - `country` - Country code (e.g. `CZE`)
    - `date` - Date in `Y-m-d` format
  - Returns
      - type: `json`
      - `message: <string>`

#### Task duration

- `GET /api/task-duration/expected-duration`
  - QUERY:
    - `taskStart` - DateTime in `Y-m-d\TH:i:s` format, **required**
    - `duration` - integer, duration in minutes, **required**
    - `workingHourStart` - Time in `H:i:s` format, **required**
    - `workingHourEnd` - Time in `H:i:s` format, **required**
    - `workingDaysOnly` - boolean, uses only working days, default `false`
  - Returns
      - type: `json`
      - `expectedDuration: DateTime` in `Y-m-d\TH:i:sP` format
