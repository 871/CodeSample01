<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FielGenerate
 *
 * @author hanai
 */
interface FielGenerate {
	/**
	 * タブ
	 */
	const TAB = "\t";
	
	/**
	 * 改行
	 */
	const LFC = "\n";
	
	public function getContents();
}