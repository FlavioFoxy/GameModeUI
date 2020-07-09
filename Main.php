<?php

namespace FlavioFoxy\GameModeUI;

use pocketmine\event\Listener;

use pocketmine\command\Command;
use pocketmine\command\CommandSender
;
use pocketmine\plugin\PluginBase;

use pocketmine\Server;
use pocketmine\Player;

class main extends PluginBase implements Listener {

	public function onEnable(){
		$this->getLogger("GameModeUI By FlavioFoxy Active Succes");
	}

	public function onDisable(){
		$this->getLogger("GameModeUI By FlavioFoxy Disable Succes");
	}

	public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args) : bool {
	    switch($cmd->getName()){
		case "gm":
		    if ($sender instanceof Player){
	 	    if ($sender->hasPermission("ffgm.ui")){
			 	$this->openMyForm($sender);
			 	} else {
			 		$sender->sendMessage("You Missing Permission");
			 	}
			 }
		break;
		}
	 return true;
	}

	public function openMyForm($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createSimpleForm(function (Player $player, int $data = null){
			$result = $data;
			if($result === null){
				return true;
			}
			switch($result){
				case 0:
					$player->setGamemode(0);
					$player->addTitle("§dSwitch Your Mode In ", "§2SurvivalMode", 25, 20, 25);
					$player->sendMessage("§3You Is Now In §2SurvivalMode");
				break;

				case 1:
					$player->setGamemode(1);
					$player->addTitle("§cSwitch Your Mode In ", "§4CreativeMode", 25, 20, 25);
					$player->sendMessage("§3You Is Now In §cCreativeMode!");
				break;

				case 2:
					$player->setGamemode(2);
					$player->addTitle("§eSwitch Your Mode In ", "§eAdventureMode!", 25, 20, 25);
					if($player->getGamemode(2) === 2){
					$player->sendMessage("You Is Now In §eAdventureMode!");
					}
				break;

				case 3:
					$player->setGamemode(3);
					$player->addTitle("§1Switch Your Mode In ", "§dSpectator!", 25, 20, 25);
					if($player->getGamemode() === 3){
					$player->sendMessage("§1You Is Now In  §dSpectatorMode!");
					}
				break;
			}
		});
		$form->setTitle("§aGame§cMode §dServer");
		$form->setContent("§aSelect Your GameMode");
		$form->addButton("§l§4SurvivalMode\nTap",0,"textures/items/beef_cooked");
		$form->addButton("§l§aCreativeMode\nTap",0,"textures/blocks/diamond_block");
		$form->addButton("§l§eAdventureMode\nTap",0,"textures/items/wood_sword");
		$form->addButton("§l§dSpectatorMode\nTap",0,"textures/items/ender_pearl");
		$form->sendToPlayer($player);
		return $form;
	}


}