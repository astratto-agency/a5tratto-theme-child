<h1>A5tratto-Theme</h1>
<h1>CHILD</h1>
<h2>V.7.4.0.6</h2>
<h3></h3>

<p>Numero Versione</p>
<p>Tipologia ( origin 0, master 1)</p>
<h2>git@github.com:a5tratto/a5tratto-theme.git</h2>
<p>serie</p>
<i>numero</p>
<h2>Variabili</h2>
<code>{{v-dominio}}</code>
<p>dominio.com</p>
<br>
<code>{{v-dominio-old}}</code>  
<p>dominio-old.com</p>
<h2>Tematiche</h2>
<ul>
	<li id="01" class="cat-macro-mamp">MAMP / XAMPP
		<ul>
			<li id="02">Impostazione Virtual Host
				<a href="https://www.venetoformazione.it/blog/come-creare-un-host-virtuale-su-mamp/">link</a>
				<p>Per impostare un virtual host bisogno andare su is eguenti file</p>
				<p>Aprire e Modificare da Termiale Bash</p>
				<ul>
					<li>httpd.conf
						<code>sudo nano /Applications/Mamp/conf/apache/httpd.conf</code>
						<p>Abilitare</p>
						<code>
							# Virtual hosts
							Include /Applications/MAMP/conf/apache/extra/httpd-vhosts.conf
						</code>	
					</li>
					<li>httpd-vhosts.conf
						<code>sudo nano /Applications/Mamp/conf/apache/extra/httpd-vhosts.conf</code>
						<p>Abilitare</p>
						<code>
							NameVirtualHost *:80
						</code>	
						<p>Aggiungere</p>
						<code>
							<VirtualHost *:80>
								DocumentRoot "/Users/giorgiorizza/SitiWeb/{{v-dominio}}/public_html"
								ServerName {{v-dominio}}
								ServerAlias http://www.{{v-dominio}}
							</VirtualHost>
						</code>	
					</li>
				</ul>	
			</li>
			<li id="03">Impostaztioni Hosts
				<p>Modificare</p>
				<code>sudo nano /private/etc/hosts</code>
				<p>Aggiungere</p>
				<code>
					##
					# Host Database
					#
					# localhost is used to configure the loopback interface
					# when the system is booting.  Do not change this entry.
					##
					127.0.0.1	localhost
					255.255.255.255	broadcasthost
					::1             localhost
					127.0.0.1	{{v-dominio}}
				</code>
			</li>
			<li id="04">Cambio Porte</li>
		</ul>
	</li>
	<li id="5" class="cat-macro-siteground">SiteGorund
		<ul>
			<li id="06">Creazione sito temporaneo
				<p>
				<a href="https://my.siteground.com/websites/list">link - Web List</a><br>
				<a href="https://my.siteground.com/services/hosting/TFFqeVpINEtMdz09">link - Piano A5TRATTO</a><br>
				<a href="https://tools.siteground.com/?siteId=TFEzMVpYNEpKQT09">link - Site Tools</a><br>
				<a href="https://my.siteground.com/website-wizard/">link - Crea Nuovo Sito</a><br>
				</p>
			</li>
			<li id="07">Intallazione WP
				<ul>
					<li id="08">File da eliminre prima dell'installazione</li>
					<li id="09">Impostazione intallazione guidata WP</li>
					<li id="10">Clone WP</li>
				</ul>
			</li>
			<li id="11">GIT
				<ul>
					<li id="12">Impostazione .gitignore 
						<p>Inserire in un file .gitignore le seguenti regole per evitare di versionare i sui seguenti file</p>
						<code>
							wp-content/upgrade/*
							wp-content/backup-db/*
							wp-content/cache/*
							wp-content/cache/supercache/*
							wp-content/w3tc-cache/*
							wp-config.php
						</code>
					</li>
					<li id="13">Eliminare cache da .gitignore <br>
						<p>Andare sulla cartella principale e inserire il prescorso del file che non sta considerando .gitignore </p>
						<code>git rm --cached wp-config.php</code>
					</li>
					<li id="14">Impostazione GIT</li>
					<p>se devi cancellare la cartella git perche viene caricato il sito web con le cartelle dei timi vuoti ricordati di canellare subito la cartella .git di ogni directory clonata con la seguente dicitura</p>
				    <code>rm -rf nomecartella</code>
				</ul>
			</li>
			<li id="15">Creazione Utente SSH
				<a href="https://it.siteground.com/tutorial/ssh/">link</a>
				<ul>
					<li id="16">Intallazione chiave ssh sul pc</li>
					<li id="17">Intallazione chiave pubblica ssh sul server
						<a href="https://it.siteground.com/tutorial/ssh/abilitare/">link</a>
					</li>
					<li id="17">Copiare chaive pubblica in ssh
					    <code>cat ~/.ssh/id_rsa.pub | pbcopy</code>
					</li>
				</ul>
			</li>
			<li id="18">My SQL
				<ul>
					<li id="19">Import Export DB</li>
					<li id="20">Abilitazione DB Remoto
						<a href="https://it.siteground.com/kb/come-creare-una-connessione-remota-al-mio-database/">link</a>
					</li>
					<li id="21">Replace WP SQL</li>
				</ul>
			</li>
			<li id="22">SSL
				<ul>
					<li id="23">Attivaiozne SSL</li>
				</ul>
			</li>
			<li id="24">Email
				<a href="https://it.siteground.com/tutorial/email/">link</a>
				<ul>
					<li id="25">Creazione Mail</li>
					<li id="26">Migrazioen Mail</li>
					<li id="27">Redirect Mail</li>
					<li id="28">Impostazioni Mail</li>
				</ul>
			</li>
			<li id="29">FTP
				<ul>
					<li id="30">Crezione Utente</li>
					<li id="31">Impostazioni Utente e Cartelle</li>
					<li id="32"></li>
				</ul>
			</li>Ottimizzazioni
			<ul>
				<li id="33">SG Cache</li>
				<li id="34">Cloud Flare</li>
			</ul>
		</li>
	</ul>
</li>
<li id="35" class="cat-macro-wp">WP
	<ul>
		<li id="36">Impostazioni WP
			<ul>
				<li id="37">Aspetto</li>
				<li id="38">Impostazioni</li>
			</ul>
		</li>
		<li id="39">Multisite
			<ul>
				<li id="40">Attivazione Multisite</li>
				<li id="41">Replace DB SQL</li>
				<li id="42">Struttura</li>
				<li id="43">Utenti</li>
			</ul>
		</li>
		<li id="44">Plugin
			<ul>
				<li id="45">ACF <br>
					<code></code>				</li>
				<li id="46">Post Type</li>
				<li id="47">All Import</li>
				<li id="48">Sucuri</li>
				<li id="49"></li>
				<li id="50"></li>
				<li id="51"></li>
				<li id="52"></li>
				<li id="53"></li>
				<li id="54"></li>
			</ul>
		</li>
		<li id="55">A5T Theme
			<ul>
				<li id="56">Installazione A5T Theme</li>
				    <p>Per intallare nuova versione della repository del tema A5T Theme</p>
				    <p>Git: git clone git@github.com:a5tratto/a5tratto-theme.git</p>
				    <p>Per intallare nuova versione della repository del tema A5T Theme Child</p>
                    <p>Git: git clone git@github.com:a5tratto/a5tratto-theme-child.git</p>
				<li id="57">Aggioranmento A5T Theme</li>
				<li id="58">Creazione Child A5T Theme
					<a href="https://kinsta.com/it/blog/child-theme-wordpress/">link</a>
				</li>
				<li id="59">Core A5T Theme
					<ul>
						<li id="60">Assets
							<ul>
								<li id="61">boostrap-4.3.1-dist</li>
								<li id="62">custom.js</li>
								<li id="63">animate.js</li>
								<li id="64">credits.js</li>
								<li id="65">custom.css</li>
								<li id="66">hover.css</li>
							</ul>
						</li>
						<li id="67">Core
							<ul>
								<li id="68">config.php</li>
								<li id="69">plugin.php</li>
								<li id="70">customizer.php</li>
								<li id="71">activation.php</li>
								<li id="72">int.php</li>
								<li id="73"></li>
								<li id="74"></li>
							</ul>
						</li>
						<li id="75">Lang</li>
						<li id="76">Twig</li>
						<li id="77">Vendor
							<ul>
								<li id="78">kint-php</li>
								<li id="79">composer</li>
								<li id="80">athari</li>
							</ul>
						</li>
						<li id="81">function.php</li>
						<li id="82">wp-cli
							<a href="https://it.siteground.com/tutorial/wordpress/wp-cli/">link</a>
						</li>
					</ul>
				</li>
				<li id="83">Template
					<p>per il template bisongo prima compredere la sua gerarchia
						<img src="https://developer.wordpress.org/files/2014/10/Screenshot-2019-01-23-00.20.04.png" alt="">
					Images: ![Images](https://developer.wordpress.org/files/2014/10/Screenshot-2019-01-23-00.20.04.png)</p>
					Images: ![Images](https://developer.wordpress.org/files/2014/10/Screenshot-2019-01-23-00.20.04.png)
					<ul>
						<li id="84">404.php</li>
						<li id="85">archive.php</li>
						<li id="86">author.php</li>
						<li id="87">category.php</li>
						<li id="88">base.php</li>
						<li id="89">index.php</li>
						<li id="90">search.php</li>
						<li id="91">searchform.php</li>
						<li id="92">single.php</li>
						<li id="93">tag.php</li>
						<li id="94">taxonomy.php</li>
						<li id="95">template-home.php</li>
						<li id="96">template-custom.php</li>
						<li id="97">footer.php</li>
						<li id="98">header.php</li>
						<li id="99">menu.php</li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
</li>
</ul>




Test Markdown document
======================

Text
----

Here is a paragraph with bold text. **This is some bold text.** Here is a
paragraph with bold text. __This is also some bold text.__

Here is another one with italic text. *This is some italic text.* Here is
another one with italic text. _This is some italic text._

Here is another one with struckout text. ~~This is some struckout text.~~


Links
-----

Autolink: <http://example.com>

Link: [Example](http://example.com)

Reference style [link][1].

[1]: http://example.com  "Example"


Images
------

Image: ![My image](https://www.jetbrains.com/phpstorm/img/screenshots/2020.1/phpstorm_debugging@2x.png)

Headers
-------

# First level title
## Second level title
### Third level title
#### Fourth level title
##### Fifth level title
###### Sixth level title

### Title with [link](http://localhost)
### Title with ![image](http://localhost)

Code
----

```
This
is
code
fence
```

Inline `code span in a` paragraph.

This is a code block:

/**
* Sorts the specified array into ascending numerical order.
*
* <p>Implementation note: The sorting algorithm is a Dual-Pivot Quicksort
	* by Vladimir Yaroslavskiy, Jon Bentley, and Joshua Bloch. This algorithm
	* offers O(n log(n)) performance on many data sets that cause other
	* quicksorts to degrade to quadratic performance, and is typically
	* faster than traditional (one-pivot) Quicksort implementations.
	*
	* @param a the array to be sorted
	*/
	public static void sort(byte[] a) {
	DualPivotQuicksort.sort(a);
}

Quotes
------

> This is the first level of quoting.
>
> > This is nested blockquote.
>
> Back to the first level.


> A list within a blockquote:
>
> *	asterisk 1
> *	asterisk 2
> *	asterisk 3


> Formatting within a blockquote:
>
> ### header
> Link: [Example](http://example.com)



Html
-------

This is inline <span>html</html>.
	And this is an html block.

	<table>
		<tr>
			<th>Column 1</th>
			<th>Column 2</th>
		</tr>
		<tr>
			<td>Row 1 Cell 1</td>
			<td>Row 1 Cell 2</td>
		</tr>
		<tr>
			<td>Row 2 Cell 1</td>
			<td>Row 2 Cell 2</td>
		</tr>
	</table>

	Horizontal rules
	----------------

	---

	___


	***


	Lists
	-----

	Unordered list:

	*	asterisk 1
	*	asterisk 2
	*	asterisk 3


	Ordered list:

	1.	First
	2.	Second
	3.	Third


	Mixed:

	1. First
	2. Second:
	* Fee
	* Fie
	* Foe
	3. Third


	Tables:

	| Header 1 | Header 2 |
	| -------- | -------- |
	| Data 1   | Data 2   |