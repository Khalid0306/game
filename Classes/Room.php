<?php

class Room {
    private string $name;
    private string $description;
    private string $type;
    private int $donjon_id;
    private int $or;


    public function __construct($room)
    {
        $this->name = $room['name'];
        $this->description = $room['description'];
        $this->type = $room['type'];
        $this->donjon_id = $room['donjon_id'];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
    public function getHTML(): string{

        $html = "";

        switch ($this->type) {
            case 'vide':
                $html .= "<p class='mt-4'><a href='donjons_play.php?id=". $this->donjon_id ."' class='btn btn-green'>Continuer l'exploration</a></p>";
                break;

            case 'treasure':
                $or = rand(0, 20);
                $_SESSION['perso']['gold'] += $or;

                $html .= "<p class='mt-4'>Vous avez gagné " . $or . " pièce d'or</p>";
                $html .= "<p class='mt-4'><a href='donjons_play.php?id=". $this->donjon_id ."' class='btn btn-green'>Continuer l'exploration</a></p>";
                break;
            
            case 'combat':
                $html .= "<p class='mt-4'><a href='donjon_fight.php?id=". $this->donjon_id ."' class='btn btn-green'>Combattre</a></p>";
                $html .= "<p class='mt-4'><a href='donjons_play.php?id=". $this->donjon_id ."' class='btn btn-green'>Fuir et continuer et explorer</a></p>";
                break;
            
            default:
                $html .= "<p>Aucune action possible !</p>";
                break;
        }

        return $html;

    }

    public function getAction(): void
    {

        switch ($this->type) {
            case 'vide':
                break;

            case 'treasure':
                $this -> or = rand(0, 20);
                $_SESSION['perso']['gold'] += $this -> or;
                break;
            
            case 'combat':
                break;
            
            default:
                break;
        }
    }

}