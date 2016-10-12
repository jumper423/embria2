<?php

namespace jumper423;

class CountingDomains
{
    /**
     * @var DataBase
     */
    private $db;
    private $limit = 100000;

    /**
     * CountingDomains constructor.
     * @param DataBase $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get()
    {
        $hosts = [];
        $offset = 0;
        do {
            $query = "SELECT GROUP_CONCAT(email), COUNT(*)
                    FROM (
                      SELECT email
                      FROM users
                      ORDER BY id
                      LIMIT $this->limit OFFSET $offset
                    ) as ch";
            list($emailsString, $count) = $this->db->row($query);
            $emailsArray = array_filter(explode(',', $emailsString));
            foreach ($emailsArray as $email) {
                list(, $host) = explode('@', $email);
                if (!array_key_exists($host, $hosts)) {
                    $hosts[$host] = 1;
                } else {
                    ++$hosts[$host];
                }
            }
            $offset+=$this->limit;
        } while ($count == $this->limit);
        return $hosts;
    }
}