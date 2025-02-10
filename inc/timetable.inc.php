<?php
declare(strict_types=1);

function fetch_username(int $userId): string {
    global $pdo;

    $stmt = $pdo->prepare('SELECT `name` from `users` WHERE `id` = :userId');
    $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['name'];
}

function fetch_userinfo(int $userId): array {
    global $pdo;

    $stmt = $pdo->prepare('SELECT `name`, `email` from `users` WHERE `id` = :userId');
    $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function fetch_upcoming_schedule(int $userId): array {
    global $pdo;
    $stmt = $pdo->prepare('SELECT `timetable`.`subject_id`, `code`, `name`,
                           `start_time`, `end_time` FROM `timetable` 
                           INNER JOIN `subjects` ON `timetable`.`subject_id` = `subjects`.`subject_id`
                           WHERE (CURTIME() BETWEEN `start_time` AND `end_time` OR `start_time` > CURTIME())
                           AND (`day` = DAYNAME(CURDATE())) AND (`subjects`.`user_id` = :userId)
                           ORDER BY `start_time` ASC');
    $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function fetch_subjects(int $userId): array {
    global $pdo;
    $stmt = $pdo->prepare(('SELECT * FROM `subjects` WHERE `user_id` = :userId'));
    $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchALL(PDO::FETCH_ASSOC);
}

function fetch_timetable(int $userId): array {
    global $pdo;
    $stmt = $pdo->prepare(('SELECT `timetable`.`subject_id`, `subjects`.`code`, `subjects`.`name`, `day`, `start_time`, `end_time`
                            FROM `timetable` INNER JOIN `subjects` ON `timetable`.`subject_id` = `subjects`.`subject_id`
                            WHERE `timetable`.`user_id` = :userId'));
    $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $classes = [];
    $week = (date('w') === '0') ? 'next': 'this';
    foreach ($results AS $result) {
        $classes[] = [
            'id' => $result['subject_id'],
            'code' => $result['code'],
            'name' => $result['name'],
            'start_unix_time' => strtotime("{$week} week {$result['day']} {$result['start_time']}"),
            'end_unix_time' => strtotime("{$week} week {$result['day']} {$result['end_time']}")
        ];
    }
    return $classes;
}

function insert_subjects(int $userId, array $subjects): void {
    global $pdo;
    $noOfSubjects = count($subjects);
    $values = str_repeat('(?,?,?),', $noOfSubjects - 1) . '(?,?,?)';
    $query = "INSERT INTO `subjects` (`code`, `name`, `user_id`) VALUES {$values}";
    $stmt = $pdo->prepare($query);
    $x = 0;
    foreach ($subjects AS $code => $name) {
        $stmt->bindValue(++$x, $code);
        $stmt->bindValue(++$x, $name);
        $stmt->bindValue(++$x, $userId, PDO::PARAM_INT);
    }
    $stmt->execute();
}

function update_timetable(int $userId, array $classes): void {
    global $pdo;
    $rows = [];
    foreach ($classes AS $class) {
        $rows[] = [
            'subject_id' => (int) ($class['id'] ?? 0),
            'day' => (string) ($class['day'] ?? ''),
            'start_time' => date('H:i:s', (int) ($class['start'] ?? 0)),
            'end_time' => date('H:i:s', (int) ($class['end'] ?? 0))
        ];
    }
    $stmt = $pdo->prepare(('DELETE FROM `timetable` WHERE `user_id` = :userId'));
    $stmt->bindValue(':userId', $userId);
    $stmt->execute();
    $noOfRows = count($rows);
    $values = str_repeat('(?,?,?,?,?),', $noOfRows - 1) . '(?,?,?,?,?)';
    $query = "INSERT INTO `timetable` (`subject_id`, `day`, `start_time`, `end_time`, `user_id`) VALUES {$values}";
    $stmt = $pdo->prepare($query);
    for ($x = $y = 0; $x < $noOfRows; $x++) {
        $stmt->bindValue(++$y, $rows[$x]['subject_id'], PDO::PARAM_INT);
        $stmt->bindValue(++$y, $rows[$x]['day']);
        $stmt->bindValue(++$y, $rows[$x]['start_time']);
        $stmt->bindValue(++$y, $rows[$x]['end_time']);
        $stmt->bindValue(++$y, $userId, PDO::PARAM_INT);
    }
    $stmt->execute();
}

function remove_subjects(int $userId, array $subjectIds): void {
    global $pdo;
    $noOfSubjects = count($subjectIds);
    $values = str_repeat('?,', $noOfSubjects - 1) . '?';
    $query = "DELETE FROM `subjects` WHERE `user_id` = ? AND `subject_id` IN ({$values})";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(1, $userId, PDO::PARAM_INT);
    for ($x = 0; $x < $noOfSubjects; $x++) {
        $stmt->bindValue($x+2, $subjectIds[$x], PDO::PARAM_INT);
    }
    $stmt->execute();
}