<?php

class Model_Base
{
  private static $_items_count_per_page = 50;

  static function find_all($options = array())
  {
    $db = option('db');

    if (isset($options['where']))
    {
      $options['sql'] .= ' WHERE ' . implode(' AND ', $options['where']);
      $options['sql_count'] .= ' WHERE ' . implode(' AND ', $options['where']);
    }

    if (isset($options['order_by'])) {
      $options['sql'] .= ' ORDER BY ' . $options['order_by'];
    }

    if (isset($options['page'])) {
      return self::paginator($options);
    }

    if (isset($options['limit'])) {
      $options['sql'] .= ' LIMIT ' . $options['limit'];
    }

    $stmt = $db->prepare($options['sql']);
    self::bindings($stmt, $options);

    if ($stmt->execute()) {
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return false;
  }

  static function paginator($options = array())
  {
    $db = option('db');

    $stmt = $db->prepare($options['sql_count']);
    self::bindings($stmt, $options);
    $stmt->execute();

    $count = $stmt->fetchColumn();

    $page = (int) $options['page'];
    $items_count_per_page = isset($options['items_count_per_page']) ? $options['items_count_per_page'] : self::$_items_count_per_page;

    if ($page < 1) $page = 1;
    if ($page > $count) $page = $count;
    if ($page == 1) $prev_page = 1;
    if ($page == $count) $next_page = $count;

    $paginator = array(
      'items_count' => $count,
      'pages_count' => ceil($count / $items_count_per_page),
      'page' => $page,
      'prev_page' => isset($prev_page) ? $prev_page : $page - 1,
      'next_page' => isset($next_page) ? $next_page : $page + 1,
      'items' => array()
    );

    $options['sql'] .= ' LIMIT ' . $items_count_per_page . ' OFFSET ' . abs(($page - 1) * $items_count_per_page);

    $stmt = $db->prepare($options['sql']);
    self::bindings($stmt, $options);

    if ($stmt->execute()) {
      $paginator['items'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $paginator;
  }

  static function bindings($stmt, $options)
  {
    if (isset($options['bindings']))
    {
      foreach ($options['bindings'] as $binding) {
        $stmt->bindValue($binding[0], $binding[1], $binding[2]);
      }
    }
  }
}
