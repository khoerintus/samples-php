# MultiWorkerActivity sample

This sample demonstrates two worker running 2 different Activity and 2 different Workflow with same task queue.

From the app folder, run the following command:

```bash
php app.php multi-worker-activity
```

For worker, start 2 different worker from the app folder
```bash
./rr -c src/MultiWorkerActivity/.rr.worker1.yaml serve
./rr -c src/MultiWorkerActivity/.rr.worker2.yaml serve
```