# Activity-manager

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


## Features list

1. User is able to participate in events (if get invited to event by event creator).
2. User is able to see list of upcomming events on dashboard.
3. User is able to view description of specific event.
4. User is able to create events.
5. Event creator is able to invite other users to participate in event by email.
6. User which get invite is able to accept or decline it.
