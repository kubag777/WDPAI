<?php

class MyList {
    private $list_id;
    private $name;
    private $users = [];
    private $fields = [];

    public function __construct(
        string $name,
        array $users = [],
        int $list_id = null
    ) {
        $this->name = $name;
        $this->list_id = $list_id;
        foreach ($users as $user) {
            if ($user instanceof User) {
                $this->addUser($user);
            }
        }
    }

    public function addUser(User $user) {
        $this->users[] = $user;
    }

    public function getUsers() {
        return $this->users;
    }
    public function removeUser(User $userToRemove) {
        $indexToRemove = null;
        foreach ($this->users as $index => $user) {
            if ($user === $userToRemove) {
                $indexToRemove = $index;
                break;
            }
        }
        if ($indexToRemove !== null) {
            unset($this->users[$indexToRemove]);
        }
    }
    public function addField(MyFields $field) {
        $this->fields[] = $field;
    }
    public function getFields() {
        return $this->fields;
    }
    public function removeField(MyFields $fieldToRemove) {
        $indexToRemove = null;
        foreach ($this->fields as $index => $field) {
            if ($field === $fieldToRemove) {
                $indexToRemove = $index;
                break;
            }
        }
        if ($indexToRemove !== null) {
            unset($this->fields[$indexToRemove]);
        }
    }
    public function getName() {
        return $this->name;
    }
    public function getListID() {
        return $this->list_id;  
    }
}