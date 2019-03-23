cache set
    - key - must be unique
    - value - will be returned
    - life - life span - (concaginated with key)
        - none (Not touched | If exists) (Set after 5 Minutes | If does not exists)
        - 5 (INT Seconds) | time as duration - auto delete - duration reset on access
        - 0 - persistance - will be updated on next cache updation

cache get
    - key

cache exists
    - key

cache delete
    - key

cache name
