<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

namespace pocketmine\network\protocol;

use pocketmine\utils\Binary;
use function chr;
use function pack;

class AddPaintingPacket extends DataPacket{
	const NETWORK_ID = Info::ADD_PAINTING_PACKET;

	public $eid;
	public $x;
	public $y;
	public $z;
	public $direction;
	public $title;

	public function decode(){

	}

	public function encode(){
		$this->buffer = chr(self::NETWORK_ID); $this->offset = 0;;
		$this->buffer .= Binary::writeLong($this->eid);
		$this->buffer .= pack("N", $this->x);
		$this->buffer .= pack("N", $this->y);
		$this->buffer .= pack("N", $this->z);
		$this->buffer .= pack("N", $this->direction);
		$this->putString($this->title);
	}

}
