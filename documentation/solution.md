# TODO:

- Create simple solution that will fetch and analyze data without async or jobs.
- Add caching implementation.
- Create job that will be dispatched in async fashion every x minutes to get the latest data and put it in cache.
- Maybe make chain of jobs without overlapping as soon the data is accessed.
- Handle race condition.
- Do not forget tests (mock the data).
