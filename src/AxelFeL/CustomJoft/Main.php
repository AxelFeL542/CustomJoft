<?php

namespace AxelFeL\CustomJoft;

use pocketmine\Server;
use pocketmine\player\Player;

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;

use _64FF00\PurePerms\PurePerms;
use _64FF00\PurePerms\DataManager\UserDataManager;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class Main extends PluginBase implements Listener {
    
    public function onEnable(): void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getLogger("Plugin CustomJoFt Enabled By AxelFeL!");
        $this->saveResource("config.yml");
    }
    
    public function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        $name = $player->getName();
        if (!class_exists(PurePerms::class)){
            $rank = "";
        } else {
            $rank = UserDataManager::getGroup($player)->getName();
        }
        $event->setJoinMessage(str_replace(["{name}", "{rank}"], [$name, $rank], $this->getConfig()->get("join-message")));
    }
    
    public function onQuit(PlayerQuitEvent $event){
        $player = $event->getPlayer();
        $name = $player->getName();
        if (!class_exists(PurePerms::class)){
            $rank = "";
        } else {
            $rank = UserDataManager::getGroup($player)->getName();
        }
        $event->setQuitMessage(str_replace(["{name}", "{rank}"], [$name, $rank], $this->getConfig()->get("left-message")));
    }
}
