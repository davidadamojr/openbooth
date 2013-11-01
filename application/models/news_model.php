<?php
class news_model extends CI_Model {
	
	public function get_news()
	{
		//get news from the cnn website
		//Quentin Mayo, Easy way to read all the headers
	//New Feed via RSS because I"M LAZY :P
	  $doc = new DOMDocument();
	  //
	  $doc->load('http://rss.cnn.com/rss/cnn_showbiz.rss');
	  //You can change the feed by copying the url from this site
	  //http://www.cnn.com/services/rss/
	  $arrFeeds = array();

	  /* Sample RSS Element
	 <item><title>Obama warns of 'Scrooge' Christmas</title><guid isPermaLink="false">http://www.cnn.com/2012/11/30/politics/fiscal-cliff/index.html</guid><link>http://rss.cnn.com/~r/rss/cnn_topstories/~3/xbr8aGflcTY/index.html</link><description>President Obama toured a toy factory and called for legislation extending tax cuts for 98% of Americans. "There's a stalemate," House Speaker John Boehner said.&lt;div class="feedflare"&gt;
	&lt;a href="http://rss.cnn.com/~ff/rss/cnn_topstories?a=xbr8aGflcTY:EQzDF1aevFE:yIl2AUoC8zA"&gt;&lt;img src="http://feeds.feedburner.com/~ff/rss/cnn_topstories?d=yIl2AUoC8zA" border="0"&gt;&lt;/img&gt;&lt;/a&gt; &lt;a href="http://rss.cnn.com/~ff/rss/cnn_topstories?a=xbr8aGflcTY:EQzDF1aevFE:7Q72WNTAKBA"&gt;&lt;img src="http://feeds.feedburner.com/~ff/rss/cnn_topstories?d=7Q72WNTAKBA" border="0"&gt;&lt;/img&gt;&lt;/a&gt; &lt;a href="http://rss.cnn.com/~ff/rss/cnn_topstories?a=xbr8aGflcTY:EQzDF1aevFE:V_sGLiPBpWU"&gt;&lt;img src="http://feeds.feedburner.com/~ff/rss/cnn_topstories?i=xbr8aGflcTY:EQzDF1aevFE:V_sGLiPBpWU" border="0"&gt;&lt;/img&gt;&lt;/a&gt; &lt;a href="http://rss.cnn.com/~ff/rss/cnn_topstories?a=xbr8aGflcTY:EQzDF1aevFE:qj6IDK7rITs"&gt;&lt;img src="http://feeds.feedburner.com/~ff/rss/cnn_topstories?d=qj6IDK7rITs" border="0"&gt;&lt;/img&gt;&lt;/a&gt; &lt;a href="http://rss.cnn.com/~ff/rss/cnn_topstories?a=xbr8aGflcTY:EQzDF1aevFE:gIN9vFwOqvQ"&gt;&lt;img src="http://feeds.feedburner.com/~ff/rss/cnn_topstories?i=xbr8aGflcTY:EQzDF1aevFE:gIN9vFwOqvQ" border="0"&gt;&lt;/img&gt;&lt;/a&gt;
	&lt;/div&gt;&lt;img src="http://feeds.feedburner.com/~r/rss/cnn_topstories/~4/xbr8aGflcTY" height="1" width="1"/&gt;</description><pubDate>Fri, 30 Nov 2012 19:39:18 EST</pubDate><feedburner:origLink>http://www.cnn.com/2012/11/30/politics/fiscal-cliff/index.html</feedburner:origLink></item>

	   */
	  foreach ($doc->getElementsByTagName('item') as $node) {
	    $itemRSS = array ( 
	      'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
	      'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
	      'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
	      'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue
	      );
	    array_push($arrFeeds, $itemRSS);
	    
	  }
	
	return $arrFeeds;	
	}	
  
}
?>