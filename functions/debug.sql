periodStartDate":"2016-12-23 00:00:00","periodEndDt":"2017-01-05 00:00:00"
SUM(IF(attendanceDt = '2016-12-23 00:00:00', weight, NULL)) AS Fri23,
SUM(IF(attendanceDt = '2016-12-24 00:00:00', weight, NULL)) AS Sat24,
SUM(IF(attendanceDt = '2016-12-25 00:00:00', weight, NULL)) AS Sun25,
SUM(IF(attendanceDt = '2016-12-26 00:00:00', weight, NULL)) AS Mon26,
SUM(IF(attendanceDt = '2016-12-27 00:00:00', weight, NULL)) AS Tue27,
SUM(IF(attendanceDt = '2016-12-28 00:00:00', weight, NULL)) AS Wed28,
SUM(IF(attendanceDt = '2016-12-30 00:00:00', weight, NULL)) AS Fri30,
SUM(IF(attendanceDt = '2016-12-31 00:00:00', weight, NULL)) AS Sat31,
SUM(IF(attendanceDt = '2017-01-01 00:00:00', weight, NULL)) AS Sun01,
SUM(IF(attendanceDt = '2017-01-02 00:00:00', weight, NULL)) AS Mon02,
SUM(IF(attendanceDt = '2017-01-03 00:00:00', weight, NULL)) AS Tue03,
SUM(IF(attendanceDt = '2017-01-04 00:00:00', weight, NULL)) AS Wed04,
SUM(IF(attendanceDt = '2017-01-05 00:00:00', weight, NULL)) AS Thu05

