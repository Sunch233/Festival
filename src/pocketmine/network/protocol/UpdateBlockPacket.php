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

use function chr;
use function count;
use function pack;

class UpdateBlockPacket extends DataPacket{
	const NETWORK_ID = Info::UPDATE_BLOCK_PACKET;

	const FLAG_NONE = 0b0000;
	const FLAG_NEIGHBORS = 0b0001;
	const FLAG_NETWORK = 0b0010;
	const FLAG_NOGRAPHIC = 0b0100;
	const FLAG_PRIORITY = 0b1000;

	const FLAG_ALL = (self::FLAG_NEIGHBORS | self::FLAG_NETWORK);
	const FLAG_ALL_PRIORITY = (self::FLAG_ALL | self::FLAG_PRIORITY);

	public $records = []; //x, z, y, blockId, blockData, flags

	public function decode(){

	}

	public function encode(){
		$this->buffer = chr(self::NETWORK_ID); $this->offset = 0;;
		$this->buffer .= pack("N", count($this->records));
		foreach($this->records as $r){
			$this->buffer .= pack("N", $r[0]);
			$this->buffer .= pack("N", $r[1]);
			$this->buffer .= chr($r[2]);
			$this->buffer .= chr($r[3]);
			$this->buffer .= chr(($r[5] << 4) | $r[4]);
		}
	}

}
