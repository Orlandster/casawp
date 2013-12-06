<?php
	if(isset($_POST['casasync_submit']))  {
		foreach ($_POST AS $key => $value) {
			if (substr($key, 0, 8) == 'casasync') {
				update_option( $key, $value );
			}
		}

/*** ADD default plugin installation ***/
		$current = isset($_GET['tab']) ? $_GET['tab'] : 'general';
		switch ($current) {
			case 'appearance':
				$checkbox_traps = array(
					'casasync_load_css',
					'casasync_load_bootstrap_scripts',
					'casasync_load_fancybox',
					'casasync_load_chosen',
					'casasync_load_googlemaps'
				);
				break;
			case 'singleview':
				$checkbox_traps = array(
					'casasync_share_facebook',
					'casasync_share_googleplus',
					'casasync_share_twitter',
					'casasync_use_captcha',
					'casasync_single_show_number_of_rooms',
			        'casasync_single_show_surface_usable',
			        'casasync_single_show_surface_living',
			        'casasync_single_show_surface_property',
			        'casasync_single_show_floor',
			        'casasync_single_show_number_of_floors',
			        'casasync_single_show_year_built',
			        'casasync_single_show_year_renovated',
				);
				break;
			case 'archiveview':
				$checkbox_traps = array(
					'casasync_archive_show_street_and_number',
					'casasync_archive_show_zip',
					'casasync_archive_show_location',
					'casasync_archive_show_number_of_rooms',
			        'casasync_archive_show_surface_usable',
			        'casasync_archive_show_surface_living',
			        'casasync_archive_show_surface_property',
			        'casasync_archive_show_floor',
			        'casasync_archive_show_number_of_floors',
			        'casasync_archive_show_year_built',
			        'casasync_archive_show_year_renovated',
			        'casasync_archive_show_price'
				);
				break;
			case 'general':
			default:
				$checkbox_traps = array(
					'casasync_live_import',
					'casasync_sellerfallback_email_use',
					'casasync_remCat',
					'casasync_remCat_email',
					'casasync_before_content',
					'casasync_after_content',
					'casasync_sellerfallback_show_organization',
					'casasync_sellerfallback_show_person_view',
					'casasync_inquiryfallback_use_email'
				);
				break;
		}

		foreach ($checkbox_traps as $trap) {
			if (!isset($_POST[$trap])) {
				update_option( $trap, '0' );
			}
		}
		echo '<div class="updated"><p><strong>' . __('Einstellungen gespeichert..', 'casasync' ) . '</strong></p></div>';
	}


	if (isset($_GET['do_import']) && !isset($_POST['casasync_submit'])) {
		if (get_option( 'casasync_live_import') == 0) {
			?> <div class="updated"><p><strong><?php _e('Daten wurden importiert..', 'casasync' ); ?></strong></p></div> <?php
		}
	}
?>


<hr>

<div class="wrap">
	<?php
		// Tabs
		$tabs = array(
			'general'     => 'Generell',
			'appearance'  => 'Design',
			'singleview'  => 'Einzelnansicht',
			'archiveview' => 'Archivansicht'
		); 
	    echo screen_icon('options-general');
	    echo '<h2 class="nav-tab-wrapper">';
	    $current = isset($_GET['tab']) ? $_GET['tab'] : 'general';
	    foreach( $tabs as $tab => $name ){
	        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
	        echo "<a class='nav-tab$class' href='?page=casasync&tab=$tab'>$name</a>";
	        
	    }
	    echo '</h2>';
	?>


	<form action="" method="post" id="options_form" name="options_form">
		<?php
			$table_start = '<table class="form-table"><tbody>';
			$table_end   = '</tbody></table>';
			switch ($current) {
				case 'appearance':
					?>
					<?php /******* Appearance *******/ ?>
						<?php echo $table_start; ?>
							<tr valign="top">
								<th scope="row">Stylesheet</th>
								<td id="front-static-pages">
									<fieldset>
										<legend class="screen-reader-text"><span>Stylesheet</span></legend>
										<?php $name = 'casasync_load_css'; ?>
										<?php $text = 'Bootstrap Stylesheet auswählen'; ?>
										<label>
											<input name="<?php echo $name ?>" type="radio" value="none" <?php echo (get_option($name) == 'none' ? 'checked="checked"' : ''); ?>> Kein Stylesheet
										</label>
										<br>
										<label>
											<input name="<?php echo $name ?>" type="radio" value="bootstrapv2" disabled <?php echo (get_option($name) == 'bootstrapv2' ? 'checked="checked"' : ''); ?>> Bootstrap Version 2
										</label>
										<br>
										<label>
											<input name="<?php echo $name ?>" type="radio" value="bootstrapv3" <?php echo (get_option($name) == 'bootstrapv3' ? 'checked="checked"' : ''); ?>> Bootstrap Version 3
										</label>
										<br>
									</fieldset>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">Scripts</th>
								<td id="front-static-pages">
									<fieldset>
										<?php $name = 'casasync_load_bootstrap_scripts'; ?>
										<?php $text = 'Bootstrap'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name, 1 ) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<br>
										<?php $name = 'casasync_load_fancybox'; ?>
										<?php $text = 'Fancybox'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name, 1 ) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<br>
										<?php $name = 'casasync_load_chosen'; ?>
										<?php $text = 'Chosen'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name, 1 ) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<br>
										<?php $name = 'casasync_load_googlemaps'; ?>
										<?php $text = 'Google Maps'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name, 1 ) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
									</fieldset>
								</td>
							</tr>
						<?php echo $table_end; ?>
					<?php
					break;
				case 'singleview':
					?>
						<?php /******* Single View *******/ ?>
						<h3>Social Media</h3>
						<?php echo $table_start; ?>
							<tr valign="top">
								<th scope="row">Folgende Social Media Plattformen anzeigen</th>
								<td id="front-static-pages">
									<fieldset>
										<legend class="screen-reader-text"><span>Folgende Social Media Plattformen anzeigen</span></legend>
										<?php $name = 'casasync_share_facebook'; ?>
										<?php $text = 'Facebook'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<br>
										<?php $name = 'casasync_share_googleplus'; ?>
										<?php $text = 'Google+'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<br>
										<?php $name = 'casasync_share_twitter'; ?>
										<?php $text = 'Twitter'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
									</fieldset>
								</td>
							</tr>
						<?php echo $table_end; ?>
						<h3>Kontakt Formular</h3>
						<?php echo $table_start; ?>
							<tr valign="top">
								<th scope="row">Massnahme gegen Spam</th>
								<td id="front-static-pages">
									<fieldset>
										<legend class="screen-reader-text"><span>Massnahme gegen Spam</span></legend>
										<?php $name = 'casasync_use_captcha'; ?>
										<?php $text = 'Captcha verwenden'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" disabled <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
									</fieldset>
								</td>
							</tr>
						<?php echo $table_end; ?>
						<h3>Dynamische Felder</h3>
						<?php echo $table_start; ?>
							<tr valign="top">
								<th scope="row">Welche Werte sollen angezeigt werden? Das 2. Feld bestimmt die Ordnung der Darstellung.</th>
								<td id="front-static-padges">
									<fieldset>
										<legend class="screen-reader-text"><span>Welche Werte sollen angezeigt werden? Das 2. Feld bestimmt die Ordnung der Darstellung.</span></legend>
										<?php $name = 'casasync_single_show_number_of_rooms'; ?>
										<?php $text = 'Anzahl Zimmer'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<?php $name = 'casasync_single_show_number_of_rooms_order'; ?>
										<label>
											<input name="<?php echo $name ?>" type="text" value="<?php echo get_option($name); ?>" class="small-text">
										</label>
										<br>
										<?php $name = 'casasync_single_show_surface_usable'; ?>
										<?php $text = 'Nutzfläche'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<?php $name = 'casasync_single_show_surface_usable_order'; ?>
										<label>
											<input name="<?php echo $name ?>" type="text" value="<?php echo get_option($name); ?>" class="small-text">
										</label>
										<br>
										<?php $name = 'casasync_single_show_surface_living'; ?>
										<?php $text = 'Wohnfläche'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<?php $name = 'casasync_single_show_surface_living_order'; ?>
										<label>
											<input name="<?php echo $name ?>" type="text" value="<?php echo get_option($name); ?>" class="small-text">
										</label>
										<br>
										<?php $name = 'casasync_single_show_surface_property'; ?>
										<?php $text = 'Grundstücksfläche'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<?php $name = 'casasync_single_show_surface_property_order'; ?>
										<label>
											<input name="<?php echo $name ?>" type="text" value="<?php echo get_option($name); ?>" class="small-text">
										</label>
										<br>
										<?php $name = 'casasync_single_show_floor'; ?>
										<?php $text = 'Etage'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<?php $name = 'casasync_single_show_floor_order'; ?>
										<label>
											<input name="<?php echo $name ?>" type="text" value="<?php echo get_option($name); ?>" class="small-text">
										</label>
										<br>
										<?php $name = 'casasync_single_show_number_of_floors'; ?>
										<?php $text = 'Anzahl Etage'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<?php $name = 'casasync_single_show_number_of_floors_order'; ?>
										<label>
											<input name="<?php echo $name ?>" type="text" value="<?php echo get_option($name); ?>" class="small-text">
										</label>
										<br>
										<?php $name = 'casasync_single_show_year_built'; ?>
										<?php $text = 'Baujahr'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<?php $name = 'casasync_single_show_year_built_order'; ?>
										<label>
											<input name="<?php echo $name ?>" type="text" value="<?php echo get_option($name); ?>" class="small-text">
										</label>
										<br>
										<?php $name = 'casasync_single_show_year_renovated'; ?>
										<?php $text = 'Letzte Renovation'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<?php $name = 'casasync_single_show_year_renovated_order'; ?>
										<label>
											<input name="<?php echo $name ?>" type="text" value="<?php echo get_option($name); ?>" class="small-text">
										</label>
										<br>
									</fieldset>
								</td>
							</tr>
						<?php echo $table_end; ?>
						<h3>Karte</h3>
						<?php echo $table_start; ?>
							<?php $name = 'casasync_single_use_zoomlevel'; ?>
							<?php $text = 'Zoomstufe'; ?>
							<tr>
								<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
								<td>
									<select name="<?php echo $name ?>" id="<?php echo $name ?>">
										<option <?php echo (get_option($name)  == '0' ? 'selected="selected"' : ''); ?> value="0">0</option>
										<option <?php echo (get_option($name)  == '1' ? 'selected="selected"' : ''); ?> value="1">1</option>
										<option <?php echo (get_option($name)  == '2' ? 'selected="selected"' : ''); ?> value="2">2</option>
										<option <?php echo (get_option($name)  == '3' ? 'selected="selected"' : ''); ?> value="3">3</option>
										<option <?php echo (get_option($name)  == '4' ? 'selected="selected"' : ''); ?> value="4">4</option>
										<option <?php echo (get_option($name)  == '5' ? 'selected="selected"' : ''); ?> value="5">5</option>
										<option <?php echo (get_option($name)  == '6' ? 'selected="selected"' : ''); ?> value="6">6</option>
										<option <?php echo (get_option($name)  == '7' ? 'selected="selected"' : ''); ?> value="7">7</option>
										<option <?php echo (get_option($name)  == '8' ? 'selected="selected"' : ''); ?> value="8">8</option>
										<option <?php echo (get_option($name)  == '9' ? 'selected="selected"' : ''); ?> value="9">9</option>
										<option <?php echo (get_option($name) == '10' ? 'selected="selected"' : ''); ?> value="10">10</option>
										<option <?php echo (get_option($name) == '11' ? 'selected="selected"' : ''); ?> value="11">11</option>
										<option <?php echo (get_option($name) == '12' ? 'selected="selected"' : ''); ?> value="12">12</option>
										<option <?php echo (get_option($name) == '13' ? 'selected="selected"' : ''); ?> value="13">13</option>
										<option <?php echo (get_option($name) == '14' ? 'selected="selected"' : ''); ?> value="14">14</option>
										<option <?php echo (get_option($name) == '15' ? 'selected="selected"' : ''); ?> value="15">15</option>
										<option <?php echo (get_option($name) == '16' ? 'selected="selected"' : ''); ?> value="16">16</option>
										<option <?php echo (get_option($name) == '17' ? 'selected="selected"' : ''); ?> value="17">17</option>
										<option <?php echo (get_option($name) == '18' ? 'selected="selected"' : ''); ?> value="18">18</option>
										<option <?php echo (get_option($name) == '19' ? 'selected="selected"' : ''); ?> value="19">19</option>
									</select>
								</td>
							</tr>
						<?php echo $table_end; ?>
					<?php
					break;
				case 'archiveview':
					?>
					<h3>Dynamische Felder</h3>
						<?php echo $table_start; ?>
							<tr valign="top">
								<th scope="row">Welche Werte sollen angezeigt werden? Das 2. Feld bestimmt die Ordnung der Darstellung.</th>
								<td id="front-static-padges">
									<fieldset>
										<legend class="screen-reader-text"><span>Welche Werte sollen angezeigt werden? Das 2. Feld bestimmt die Ordnung der Darstellung.</span></legend>
										<?php $name = 'casasync_archive_show_street_and_number'; ?>
										<?php $text = 'Strasse + Nr'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<?php $name = 'casasync_archive_show_street_and_number_order'; ?>
										<label>
											<input name="<?php echo $name ?>" type="text" value="<?php echo get_option($name); ?>" class="small-text">
										</label>
										<br>
										<?php $name = 'casasync_archive_show_zip'; ?>
										<?php $text = 'PLZ'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<br>
										<?php $name = 'casasync_archive_show_location'; ?>
										<?php $text = 'Ort'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<?php $name = 'casasync_archive_show_location_order'; ?>
										<label>
											<input name="<?php echo $name ?>" type="text" value="<?php echo get_option($name); ?>" class="small-text">
										</label>
										<br>
										<?php $name = 'casasync_archive_show_number_of_rooms'; ?>
										<?php $text = 'Anzahl Zimmer'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<?php $name = 'casasync_archive_show_number_of_rooms_order'; ?>
										<label>
											<input name="<?php echo $name ?>" type="text" value="<?php echo get_option($name); ?>" class="small-text">
										</label>
										<br>
										<?php $name = 'casasync_archive_show_surface_usable'; ?>
										<?php $text = 'Nutzfläche'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<?php $name = 'casasync_archive_show_surface_usable_order'; ?>
										<label>
											<input name="<?php echo $name ?>" type="text" value="<?php echo get_option($name); ?>" class="small-text">
										</label>
										<br>
										<?php $name = 'casasync_archive_show_surface_living'; ?>
										<?php $text = 'Wohnfläche'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<?php $name = 'casasync_archive_show_surface_living_order'; ?>
										<label>
											<input name="<?php echo $name ?>" type="text" value="<?php echo get_option($name); ?>" class="small-text">
										</label>
										<br>
										<?php $name = 'casasync_archive_show_surface_property'; ?>
										<?php $text = 'Grundstücksfläche'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<?php $name = 'casasync_archive_show_surface_property_order'; ?>
										<label>
											<input name="<?php echo $name ?>" type="text" value="<?php echo get_option($name); ?>" class="small-text">
										</label>
										<br>
										<?php $name = 'casasync_archive_show_floor'; ?>
										<?php $text = 'Etage'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<?php $name = 'casasync_archive_show_floor_order'; ?>
										<label>
											<input name="<?php echo $name ?>" type="text" value="<?php echo get_option($name); ?>" class="small-text">
										</label>
										<br>
										<?php $name = 'casasync_archive_show_number_of_floors'; ?>
										<?php $text = 'Anzahl Etage'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<?php $name = 'casasync_archive_show_number_of_floors_order'; ?>
										<label>
											<input name="<?php echo $name ?>" type="text" value="<?php echo get_option($name); ?>" class="small-text">
										</label>
										<br>
										<?php $name = 'casasync_archive_show_year_built'; ?>
										<?php $text = 'Baujahr'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<?php $name = 'casasync_archive_show_year_built_order'; ?>
										<label>
											<input name="<?php echo $name ?>" type="text" value="<?php echo get_option($name); ?>" class="small-text">
										</label>
										<br>
										<?php $name = 'casasync_archive_show_year_renovated'; ?>
										<?php $text = 'Letzte Renovation'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<?php $name = 'casasync_archive_show_year_renovated_order'; ?>
										<label>
											<input name="<?php echo $name ?>" type="text" value="<?php echo get_option($name); ?>" class="small-text">
										</label>
										<br>
										<?php $name = 'casasync_archive_show_price'; ?>
										<?php $text = 'Preis'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
										<?php $name = 'casasync_archive_show_price_order'; ?>
										<label>
											<input name="<?php echo $name ?>" type="text" value="<?php echo get_option($name); ?>" class="small-text">
										</label>
										<br>
									</fieldset>
								</td>
							</tr>
						<?php echo $table_end; ?>
						<?php
					break;
				case 'general':
				default:
					?>
						<?php /******* General *******/ ?>
						<?php echo $table_start; ?>
							<tr valign="top">
								<th scope="row">Synchronisation mit Exporter/Marklersoftware</th>
								<td id="front-static-pages">
									<fieldset>
										<legend class="screen-reader-text"><span>Synchronisation mit Exporter/Marklersoftware</span></legend>
										<?php $name = 'casasync_live_import'; ?>
										<?php $text = 'Änderungen automatisch bei jedem Aufruff überprüffen und updaten.'; ?>
										<p><label>
											<?php
												$url = get_admin_url('', 'admin.php?page=casasync');
												$manually = $url . '&do_import=true';
												$forced = $manually . '&force_all_properties=true&force_last_import=true';
											?>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?> <a href="<?php echo $manually  ?>">manueller Import</a> ∙ <a href="<?php echo $forced  ?>">erzwungener Import</a>
										</label></p>
									</fieldset>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">RemCat ist eine Tranfertechnology die Anfragen per E-Mail mittels standart versendet</th>
								<td id="front-static-pages">
									<fieldset>
										<legend class="screen-reader-text"><span>RemCat ist eine Tranfertechnology die Anfragen per E-Mail mittels standart versendet</span></legend>
										<?php $name = 'casasync_remCat'; ?>
										<?php $text = 'RemCat aktivieren'; ?>
										<p><label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label></p>

										<?php $name = 'casasync_remCat_email'; ?>
										<?php $text = 'RemCat Email Adresse'; ?>
										<p>
											<input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span>
										</p>
									</fieldset>
								</td>
							</tr>
							<tr valign="top">
								<?php $name = 'casasync_sellerfallback_email_use'; ?>
								<?php $text = 'Wann sollen Anfragen an die Kontakt E-Mail Adresse versendet werden?'; ?>
								<th scope="row"><?php echo $text ?></th>
								<td id="front-static-pages">
									<fieldset>
										<legend class="screen-reader-text"><span><?php echo $text ?></span></legend>
										<label>
											<input name="<?php echo $name ?>" type="radio" value="never" <?php echo (get_option($name) == 'never' ? 'checked="checked"' : ''); ?>> Niemals
										</label>
										<br>
										<label>
											<input name="<?php echo $name ?>" type="radio" value="fallback" <?php echo (get_option($name) == 'fallback' ? 'checked="checked"' : ''); ?>> Falls keine RemCat Adresse angegeben wurde
										</label>
										<br>
										<label>
											<input name="<?php echo $name ?>" type="radio" value="always" <?php echo (get_option($name) == 'always' ? 'checked="checked"' : ''); ?>> Immer
										</label>
									</fieldset>
								</td>
							</tr>
							<tr valign="top">
								<th scrope="row">HTML einfügen</th>
								<td id="front-static-pages">
									<fieldset>
										<legend class="screen-reader-text"><span>Vor dem Plugin</span></legend>
										<?php $name = 'casasync_before_content'; ?>
										<?php $text = 'Vor dem Inhalt'; ?>
										<p><?php echo $text; ?></p>
										<p><label>
											<textarea placeholder="<div id='content'>" name="<?php echo $name ?>" id="<?php echo $name; ?>" class="large-text code" rows="2" cols="50"><?php echo stripslashes(get_option($name)); ?></textarea> 
										</label></p>
									</fieldset>
									<fieldset>
										<legend class="screen-reader-text"><span>Nach dem Plugin</span></legend>
										<?php $name = 'casasync_after_content'; ?>
										<?php $text = 'Nach dem Inhalt'; ?>
										<p><?php echo $text; ?></p>
										<p><label>
											<textarea placeholder="</div>" name="<?php echo $name ?>" id="<?php echo $name; ?>" class="large-text code" rows="2" cols="50"><?php echo stripslashes(get_option($name)); ?></textarea> 
										</label></p>
									</fieldset>
								</td>
							</tr>
						<?php echo $table_end; ?>
						<h3>Standard Anbieter</h3>
						<p>Nachfolgend können Sie Standardwerte für die Firma, Kontaktperson und Kontaktemail definieren.</p>
						<?php echo $table_start; ?>
							<tr valign="top">
								<th scrope="row"><b>Organisation</b></th>
								<td id="front-static-pages">
									<fieldset>
										<legend class="screen-reader-text"><span>Organisation</span></legend>
										<?php $name = 'casasync_sellerfallback_show_organization'; ?>
										<?php $text = 'Organisation anzeigen, wenn beim Objekt keine vorhanden ist.'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
									</fieldset>
								</td>
							</tr>
							<?php $name = 'casasync_sellerfallback_legalname'; ?>
							<?php $text = 'Organisation Name'; ?>
							<tr>
								<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
								<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
							</tr>
							<?php $name = 'casasync_sellerfallback_address_street'; ?>
							<?php $text = 'Strasse'; ?>
							<tr>
								<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
								<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
							</tr>
							<?php $name = 'casasync_sellerfallback_address_postalcode'; ?>
							<?php $text = 'PLZ'; ?>
							<tr>
								<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
								<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
							</tr>
							<?php $name = 'casasync_sellerfallback_address_locality'; ?>
							<?php $text = 'Ort'; ?>
							<tr>
								<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
								<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
							</tr>
							<?php $name = 'casasync_sellerfallback_address_region'; ?>
							<?php $text = 'Kanton'; ?>
							<tr>
								<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
								<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
							</tr>
							<?php $name = 'casasync_sellerfallback_address_country'; ?>
							<?php $text = 'Land'; ?>
							<tr>
								<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
								<td>
									<select name="<?php echo $name ?>" id="<?php echo $name ?>">
										<option <?php echo (get_option($name) == '' ? 'selected="selected"' : ''); ?> value="">-</option>
										<option <?php echo (get_option($name) == 'CH' ? 'selected="selected"' : ''); ?> value="CH">Schweiz</option>
										<option <?php echo (get_option($name) == 'DE' ? 'selected="selected"' : ''); ?> value="DE">Deutschland</option>
										<option <?php echo (get_option($name) == 'FR' ? 'selected="selected"' : ''); ?> value="FR">Frankreich</option>
										<option <?php echo (get_option($name) == 'AT' ? 'selected="selected"' : ''); ?> value="AT">Österreich</option>
										<option <?php echo (get_option($name) == 'FL' ? 'selected="selected"' : ''); ?> value="FL">Fürstenthum Liechtenstein</option>
									</select>
								</td>
							</tr>
							<?php $name = 'casasync_sellerfallback_email'; ?>
							<?php $text = 'E-Mail Adresse'; ?>
							<tr>
								<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
								<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
							</tr>
							<?php $name = 'casasync_sellerfallback_phone_central'; ?>
							<?php $text = 'Telefon Geschäft'; ?>
							<tr>
								<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
								<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
							</tr>
							<?php $name = 'casasync_sellerfallback_phone_direct'; ?>
							<?php $text = 'Direktwahl'; ?>
							<tr>
								<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
								<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
							</tr>
							<?php $name = 'casasync_sellerfallback_phone_mobile'; ?>
							<?php $text = 'Mobile'; ?>
							<tr>
								<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
								<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
							</tr>
							<?php $name = 'casasync_sellerfallback_fax'; ?>
							<?php $text = 'Fax'; ?>
							<tr>
								<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
								<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
							</tr>
						<?php echo $table_end; ?>
						<?php echo $table_start; ?>
							<tr>
								<td></td>
							</tr>
							<tr valign="top">
								<th scrope="row"><b>Kontaktperson</b></th>
								<td id="front-static-pages">
									<fieldset>
										<legend class="screen-reader-text"><span>Kontaktperson</span></legend>
										<?php $name = 'casasync_sellerfallback_show_person_view'; ?>
										<?php $text = 'Kontaktperson anzeigen, wenn beim Objekt keine vorhanden ist.'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
									</fieldset>
								</td>
							</tr>
							<?php $name = 'casasync_salesperson_fallback_gender'; ?>
							<?php $text = 'Geschlecht'; ?>
							<tr>
								<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
								<td>
									<select name="<?php echo $name ?>" id="<?php echo $name ?>">
										<option <?php echo (get_option($name) == 'F' ? 'selected="selected"' : ''); ?> value="F">Frau</option>
										<option <?php echo (get_option($name) == 'M' ? 'selected="selected"' : ''); ?> value="M">Herr</option>
									</select>
								</td>
							</tr>
							<?php $name = 'casasync_salesperson_fallback_givenname'; ?>
							<?php $text = 'Vorname'; ?>
							<tr>
								<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
								<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
							</tr>
							<?php $name = 'casasync_salesperson_fallback_familyname'; ?>
							<?php $text = 'Nachname'; ?>
							<tr>
								<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
								<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
							</tr>
							<?php $name = 'casasync_salesperson_fallback_function'; ?>
							<?php $text = 'Funktion'; ?>
							<tr>
								<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
								<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
							</tr>
							<?php $name = 'casasync_salesperson_fallback_email'; ?>
							<?php $text = 'E-Mail Adresse'; ?>
							<tr>
								<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
								<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
							</tr>
							<?php $name = 'casasync_salesperson_fallback_phone_central'; ?>
							<?php $text = 'Telefon Geschäft'; ?>
							<tr>
								<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
								<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
							</tr>
							<?php $name = 'casasync_salesperson_fallback_phone_direct'; ?>
							<?php $text = 'Direktwahl'; ?>
							<tr>
								<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
								<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
							</tr>
							<?php $name = 'casasync_salesperson_fallback_phone_mobile'; ?>
							<?php $text = 'Mobile'; ?>
							<tr>
								<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
								<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
							</tr>
							<?php $name = 'casasync_salesperson_fallback_fax'; ?>
							<?php $text = 'Fax'; ?>
							<tr>
								<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
								<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
							</tr>
						<?php echo $table_end; ?>
						<?php echo $table_start; ?>
							<tr>
								<td></td>
							</tr>
							<tr valign="top">
								<th scrope="row"><b>Kontakt E-Mail Adresse</b></th>
								<td id="front-static-pages">
									<fieldset>
										<legend class="screen-reader-text"><span>Kontakt E-Mail Adresse</span></legend>
										<?php $name = 'casasync_inquiryfallback_use_email'; ?>
										<?php $text = 'Kontakt E-Mail Adresse verwenden, wenn beim Objekt keine vorhanden ist.'; ?>
										<label>
											<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
										</label>
									</fieldset>
								</td>
							</tr>
							<?php $name = 'casasync_inquiryfallback_person_email'; ?>
							<?php $text = 'E-Mail Adresse'; ?>
							<tr>
								<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
								<td>
									<input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text">
									<br><span class="description">Diese E-Mail Adresse wird beim Kontaktformular verwendet.</span>
								</td>
							</tr>
						<?php echo $table_end; ?>
					<?php
					break;
			}
		?>
		<p class="submit"><input type="submit" name="casasync_submit" id="submit" class="button button-primary" value="Änderungen übernehmen"></p>
	</form>
<hr>

<div class="wrap" style="display: none;">
    <?php screen_icon('options-general'); ?>
    <h2>CasaSync Optionen</h2>

	<form action="" method="post" id="options_form" name="options_form">

	<h3>Generell</h3>
	<table class="form-table">
		<tbody>
			
			<tr valign="top">
				<th scope="row">Verkäufer/Anbieter</th>
				<td id="front-static-pages">
					<fieldset>
						<legend class="screen-reader-text"><span>Verkäufer/Anbieter</span></legend>
						<?php $name = 'casasync_sellerfallback_show'; ?>
						<?php $text = 'Verkäufer/Anbieter (untere angeben) anzeigen wenn beim Objekt kein Verkäufer vorhanden ist'; ?>
						<p><label>
							<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
						</label></p>

						<?php $name = 'casasync_sellerfallback_update'; ?>
						<?php $text = 'Verkäufer/Anbieter mit dem Exporter/Maklersoftware synchronisieren'; ?>
						<p><label>
							<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
						</label></p>
					</fieldset>
				</td>
			</tr>

		</tbody>
	</table>


	<h3>Verkäufer/Anbieter Adresse</h3>
	<table class="form-table">
		<tbody>



			<?php $name = 'casasync_sellerfallback_address_street'; ?>
			<?php $text = 'Strasse'; ?>
			<tr>
				<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
				<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
			</tr>


			<?php $name = 'casasync_sellerfallback_address_postalcode'; ?>
			<?php $text = 'PLZ'; ?>
			<tr>
				<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
				<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
			</tr>

			<?php $name = 'casasync_sellerfallback_address_locality'; ?>
			<?php $text = 'Ort'; ?>
			<tr>
				<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
				<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
			</tr>

			<?php $name = 'casasync_sellerfallback_address_region'; ?>
			<?php $text = 'Kanton'; ?>
			<tr>
				<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
				<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
			</tr>


			<?php $name = 'casasync_sellerfallback_address_country'; ?>
			<?php $text = 'Land'; ?>
			<tr>
				<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
				<td>
					<select name="<?php echo $name ?>" id="<?php echo $name ?>">
						<option <?php echo (get_option($name) == '' ? 'selected="selected"' : ''); ?> value="">-</option>
						<option <?php echo (get_option($name) == 'CH' ? 'selected="selected"' : ''); ?> value="CH">Schweiz</option>
						<option <?php echo (get_option($name) == 'DE' ? 'selected="selected"' : ''); ?> value="DE">Deutschland</option>
						<option <?php echo (get_option($name) == 'FR' ? 'selected="selected"' : ''); ?> value="FR">Frankreich</option>
						<option <?php echo (get_option($name) == 'AT' ? 'selected="selected"' : ''); ?> value="AT">Österreich</option>
						<option <?php echo (get_option($name) == 'FL' ? 'selected="selected"' : ''); ?> value="FL">Fürstenthum Liechtenstein</option>
					</select>
				</td>
			</tr>
		</tbody>
	</table>


	<h3>Verkäufer/Anbieter Angaben</h3>
	<table class="form-table">
		<tbody>


			<?php $name = 'casasync_sellerfallback_legalname'; ?>
			<?php $text = 'Firma Name'; ?>
			<tr>
				<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
				<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
			</tr>

			<?php $name = 'casasync_sellerfallback_email'; ?>
			<?php $text = '<strong>E-Mail Adresse</strong>'; ?>
			<tr>
				<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
				<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
			</tr>

			<?php $name = 'casasync_sellerfallback_fax'; ?>
			<?php $text = 'Fax'; ?>
			<tr>
				<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
				<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
			</tr>

			<?php $name = 'casasync_sellerfallback_phone_direct'; ?>
			<?php $text = 'Direktwahl'; ?>
			<tr>
				<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
				<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
			</tr>

			<?php $name = 'casasync_sellerfallback_phone_central'; ?>
			<?php $text = 'Firma Telefon'; ?>
			<tr>
				<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
				<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
			</tr>

			<?php $name = 'casasync_sellerfallback_phone_mobile'; ?>
			<?php $text = 'Mobile'; ?>
			<tr>
				<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
				<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
			</tr>
		</tbody>
	</table>


	<h3>Technische Feedback Adresse</h3>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row">Optionen</th>
				<td id="front-static-pages">
					<fieldset>
						<legend class="screen-reader-text"><span>Optionen</span></legend>
						<?php $name = 'casasync_feedback_update'; ?>
						<?php $text = 'Mit dem Exporter/Maklersoftware synchronisieren'; ?>
						<p><label>
							<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
						</label></p>

						<?php $name = 'casasync_feedback_creations'; ?>
						<?php $text = '<strong>Erstellungs-Rückmeldungen</strong> aktivieren'; ?>
						<p><label>
							<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
						</label></p>

						<?php $name = 'casasync_feedback_edits'; ?>
						<?php $text = '<strong>Berabeitungs-Rückmeldungen</strong> aktivieren'; ?>
						<p><label>
							<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
						</label></p>

						<?php $name = 'casasync_feedback_inquiries'; ?>
						<?php $text = 'Kopie von allen Anfragen hierehin versenden'; ?>
						<p><label>
							<input name="<?php echo $name ?>" type="checkbox" value="1" class="tog" <?php echo (get_option($name) ? 'checked="checked"' : ''); ?> > <?php echo $text ?>
						</label></p>
					</fieldset>
				</td>
			</tr>

			<?php $name = 'casasync_feedback_gender'; ?>
			<?php $text = 'Titel'; ?>
			<tr>
				<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
				<td>
					<select name="<?php echo $name ?>" id="<?php echo $name ?>">
						<option <?php echo (get_option($name) == 'M' ? 'selected="selected"' : ''); ?> value="M">Herr</option>
						<option <?php echo (get_option($name) == 'F' ? 'selected="selected"' : ''); ?> value="F">Frau</option>
					</select>
				</td>
			</tr>

			<?php $name = 'casasync_feedback_given_name'; ?>
			<?php $text = 'Vorname'; ?>
			<tr>
				<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
				<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
			</tr>

			<?php $name = 'casasync_feedback_family_name'; ?>
			<?php $text = 'Nachname'; ?>
			<tr>
				<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
				<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
			</tr>

			<?php $name = 'casasync_feedback_email'; ?>
			<?php $text = '<strong>E-Mail Adresse</strong>'; ?>
			<tr>
				<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
				<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
			</tr>

			<?php $name = 'casasync_feedback_telephone'; ?>
			<?php $text = 'Telefon'; ?>
			<tr>
				<th><label for="<?php echo $name; ?>"><?php echo $text ?></label></th>
				<td><input name="<?php echo $name ?>" id="<?php echo $name; ?>" type="text" value="<?php echo get_option($name); ?>" class="regular-text"> <span class="description"></span></td>
			</tr>

		</tbody>
	</table>


	<p class="submit"><input type="submit" name="casasync_submit" id="submit" class="button button-primary" value="Änderungen übernehmen"></p>


	</form>

</div>