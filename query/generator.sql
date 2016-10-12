DELIMITER //

DROP PROCEDURE IF EXISTS  `genetaror`;
CREATE PROCEDURE `genetaror` (IN genCount INT)
  BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE queryString TEXT;
    DECLARE queryInsert TEXT;

    SET queryString = '';
    WHILE i < genCount DO

      SET queryInsert = CONCAT(
          '(\'',
          SUBSTRING(MD5(RAND()) FROM 1 FOR 6), '\',',
          MOD(i, 2),',\'',
          CONCAT(SUBSTRING(MD5(RAND()) FROM 1 FOR 6), '@', SUBSTRING(MD5(RAND()) FROM 1 FOR 3), '.com'),',',
          CONCAT(SUBSTRING(MD5(RAND()) FROM 1 FOR 6), '@', SUBSTRING(MD5(RAND()) FROM 1 FOR 3), '.com'),',',
          CONCAT(SUBSTRING(MD5(RAND()) FROM 1 FOR 6), '@', SUBSTRING(MD5(RAND()) FROM 1 FOR 3), '.com'),
          '\'',
          ')'
      );
      IF MOD(i, 1000) = 0
      THEN
        SET @queryString = CONCAT('INSERT INTO `users`(
                                    `name`,
                                    `gender`,
                                    `email`
                                    ) VALUES ',
                                  queryString, queryInsert);
        PREPARE queryPrePare FROM @queryString;
        EXECUTE queryPrePare;
        SET queryString = '';
      ELSE
        SET queryString = CONCAT(queryString, queryInsert, ',');
      END IF;
      SET i = i + 1;
    END WHILE;
  END//

DELIMITER ;

CALL genetaror(1000000);