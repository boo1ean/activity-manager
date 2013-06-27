Activity-manager
================

Yii2 application dedicated to manage your (sport) activity.

## Entities

1. User
    - id
    - email
    - password
    - first_name
    - last_name
    - created_time
    - updated_time

2. Event
    - id
    - created_time
    - updated_time
    - created_by
    - updated_by
    - title
    - description
    - start_time
    - end_time

3. EventMember
    - id
    - created_time
    - updated_time
    - created_by
    - updated_by
    - event_id
    - user_id
    - status
