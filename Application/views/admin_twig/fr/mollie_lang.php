<?php

$sLangName = "Français";
// -------------------------------
// RESOURCE IDENTITFIER = STRING
// -------------------------------
$aLang = array(
    'charset'                                           => 'UTF-8',

    /* SETTINGS */
    'SHOP_MODULE_GROUP_MOLLIE_GENERAL'                  => 'Configuration de base',
    'SHOP_MODULE_sMollieMode'                           => 'Mode',
    'SHOP_MODULE_sMollieMode_live'                      => 'Live',
    'SHOP_MODULE_sMollieMode_test'                      => 'Test',
    'SHOP_MODULE_sMollieTestToken'                      => 'Clé API Test',
    'SHOP_MODULE_sMollieLiveToken'                      => 'Clé API Live',
    'SHOP_MODULE_blMollieShowIcons'                     => 'Afficher les icônes',
    'SHOP_MODULE_blMollieLogTransactionInfo'            => 'Journaliser le résultat du traitement des transactions',
    'SHOP_MODULE_blMollieRemoveDeactivatedMethods'      => 'Retirer les types de paiements désactivés',
    'SHOP_MODULE_blMollieRemoveByBillingCountry'        => 'Remove not supported payment types by billing country',
    'SHOP_MODULE_GROUP_MOLLIE_STATUS_MAPPING'           => 'Correspondances des statuts',
    'SHOP_MODULE_sMollieStatusPending'                  => 'Statut En attente',
    'SHOP_MODULE_sMollieStatusProcessing'               => 'Statut En traitement',
    'SHOP_MODULE_sMollieStatusCancelled'                => 'Statut Annulé',
    'SHOP_MODULE_GROUP_MOLLIE_CRONJOBS'                 => 'Cronjobs',
    'SHOP_MODULE_sMollieCronOrderExpiryActive'          => 'Cronjob "Annuler automatiquement les commandes non-payées" actif',
    'SHOP_MODULE_sMollieCronFinishOrdersActive'         => 'Cronjob "Clôture des commandes payées mais non-terminées" actif',
    'SHOP_MODULE_sMollieCronSecondChanceActive'         => 'Cronjob "Envoi des emails de rappel de paiement" actif',
    'SHOP_MODULE_iMollieCronSecondChanceTimeDiff'       => 'Délai au-delà duquel l\'email de rappel de paiement est envoyé',
    'SHOP_MODULE_sMollieCronOrderShipmentActive'        => 'Cronjob "Transmission des statuts de livraison à Mollie" actif',
    'SHOP_MODULE_sMollieCronCaptureOrdersActive'        => 'Cronjob "Encaissement des paiements" actif',
    'SHOP_MODULE_GROUP_MOLLIE_PAYMENTLOGOS'             => 'Logos de paiement alternatifs',
    'SHOP_MODULE_GROUP_MOLLIE_APPLEPAY'                 => 'Apple Pay',
    'SHOP_MODULE_blMollieApplePayButtonOnBasket'        => 'Afficher le bouton Apple Pay sur la page du panier',
    'SHOP_MODULE_blMollieApplePayButtonOnDetails'       => 'Afficher le bouton Apple Pay sur la page du détail du produit',

    'HELP_SHOP_MODULE_blMollieShowIcons'                => 'Afficher les icônes de paiement sur le Checkout',
    'HELP_SHOP_MODULE_blMollieLogTransactionInfo'       => 'Le fichier de journalisation se trouve ici: SHOPROOT/log/MollieTransactions.log',
    'HELP_SHOP_MODULE_blMollieRemoveDeactivatedMethods' => 'Retirer les types de paiement de la sélection (frontend), qui ne sont pas activés dans le tableau de bord Mollie et provoqueraient donc une erreur.',
    'HELP_SHOP_MODULE_blMollieRemoveByBillingCountry'   => 'Removes the payment types from the frontend payment selection which are not supported for the billing country given by the customer and thus would result in an error.',
    'HELP_SHOP_MODULE_sMollieStatusPending'             => 'Définir le statut de commande avant que le client ne soit redirigé vers le portail de paiement',
    'HELP_SHOP_MODULE_sMollieStatusProcessing'          => 'Définir le statut de commande pour les paiement achevés',
    'HELP_SHOP_MODULE_sMollieStatusCancelled'           => 'Définir le statut de commande pour les commandes annulées',
    'HELP_SHOP_MODULE_sMollieCronOrderExpiryActive'     => 'Pour que ce cronjob fonctionne, en plus de cette case à cocher vous devez vous assurer que le cronjob Mollie est correctement configuré. Vous pouvez trouver comment configurer le cronjob dans le fichier README.md de ce module.',
    'HELP_SHOP_MODULE_sMollieCronFinishOrdersActive'    => 'Ce cronjob a pour tâche de compléter les commandes où le client a payé avec succès mais qui n\'est visiblement pas retourné à la boutique pour finaliser le processus. Le cronjob termine uniquement les commandes des 24 dernières heures, pour ne pas changer les commandes qui ont probablement été traitées manuellement.<br><br>Pour que ce cronjob fonctionne, en plus de cette case à cocher vous devez vous assurer que le cronjob Mollie est correctement configuré. Vous pouvez trouver comment configurer le cronjob dans le fichier README.md de ce module.',
    'HELP_SHOP_MODULE_sMollieCronSecondChanceActive'    => 'Pour que ce cronjob fonctionne, en plus de cette case à cocher vous devez vous assurer que le cronjob Mollie est correctement configuré. Vous pouvez trouver comment configurer le cronjob dans le fichier README.md de ce module.',
    'HELP_SHOP_MODULE_sMollieCronOrderShipmentActive'   => 'Ce cronjob est requis uniquement si le statut de livraison dans votre boutique est paramétré par un service externe et PAS par le bouton "Expédier maintenant". Pour que ce cronjob fonctionne, en plus de cette case à cocher vous devez vous assurer que le cronjob Mollie est correctement configuré. Vous pouvez trouver comment configurer le cronjob dans le fichier README.md de ce module.',

    'MOLLIE_YES'                                        => 'Oui',
    'MOLLIE_NO'                                         => 'Non',
    'MOLLIE_DAY'                                        => 'jour',
    'MOLLIE_DAYS'                                       => 'jours',
    'MOLLIE_IS_MOLLIE'                                  => 'C\'est un mode paiement Mollie',
    'MOLLIE_IS_METHOD_ACTIVATED'                        => 'Ce mode de paiement n\'est pas activé dans votre compte Mollie!',
    'MOLLIE_TOKEN_NOT_CONFIGURED'                       => 'Votre jeton Mollie n\'était pas encore configuré!',
    'MOLLIE_CONFIG_METHOD'                              => 'Méthode API',
    'MOLLIE_DUE_DATE'                                   => 'Dates d\'échéance',
    'MOLLIE_BANKTRANSFER_PENDING'                       => 'Statut en attente',
    'MOLLIE_LIST_STYLE'                                 => 'Style de liste des émetteurs',
    'MOLLIE_LIST_STYLE_DROPDOWN'                        => 'Liste déroulante',
    'MOLLIE_LIST_STYLE_IMAGES'                          => 'Liste avec images',
    'MOLLIE_LIST_STYLE_DONT_SHOW'                       => 'Ne pas montrer la liste des émetteurs',
    'MOLLIE_ADD_QR'                                     => 'Ajouter l\'option QR-Code dans la liste des émetteurs',
    'MOLLIE_ORDER_REFUND'                               => 'Mollie',
    'MOLLIE_REFUND_SUCCESSFUL'                          => 'Remboursement réussi.',
    'MOLLIE_NO_MOLLIE_PAYMENT'                          => 'Cette commande n\'a pas été payée avec Mollie.',
    'MOLLIE_REFUND_QUANTITY'                            => 'Quantité remboursée',
    'MOLLIE_REFUND_AMOUNT'                              => 'Montant remboursé',
    'MOLLIE_TYPE_SELECT_LABEL'                          => 'Remboursé par',
    'MOLLIE_QUANTITY'                                   => 'Quantité',
    'MOLLIE_NOTICE'                                     => 'Note',
    'MOLLIE_AMOUNT'                                     => 'Montant',
    'MOLLIE_HEADER_ORDERED'                             => 'Commandé',
    'MOLLIE_HEADER_REFUNDED'                            => 'Remboursé',
    'MOLLIE_HEADER_SINGLE_PRICE'                        => 'Prix unitaire',
    'MOLLIE_SHIPPINGCOST'                               => "Frais d\'expédition",
    'MOLLIE_PAYMENTTYPESURCHARGE'                       => "Frais de paiement",
    'MOLLIE_WRAPPING'                                   => "Emballage cadeau",
    'MOLLIE_GIFTCARD'                                   => "Carte de voeux",
    'MOLLIE_VOUCHER'                                    => 'Coupon',
    'MOLLIE_DISCOUNT'                                   => 'Rabais',
    'MOLLIE_REFUND_SUBMIT'                              => 'Opérer le remboursement',
    'MOLLIE_FULL_REFUND'                                => 'Remboursement complet',
    'MOLLIE_PARTIAL_REFUND'                             => 'Remboursement partiel',
    'MOLLIE_FULL_REFUND_TEXT'                           => 'Opérer un remboursement complet avec le montant de',
    'MOLLIE_FULL_REFUND_NOT_AVAILABLE'                  => 'Un remboursement complet n\'est plus possible pour cette commande, il y a déjà eu un remboursement partiel.',
    'MOLLIE_REFUND_DESCRIPTION'                         => 'Avis de remboursement',
    'MOLLIE_REFUND_DESCRIPTION_PLACEHOLDER'             => 'facultatif - max 140 caractères',
    'MOLLIE_REFUND_FREE_AMOUNT'                         => 'Montant du remboursement gratuit',
    'MOLLIE_REFUND_FREE_1'                              => 'Du prix total de',
    'MOLLIE_REFUND_FREE_2'                              => ',',
    'MOLLIE_REFUND_FREE_3'                              => 'a déjà été remboursé. Montant remboursable restant',
    'MOLLIE_ORDER_NOT_REFUNDABLE'                       => 'Cette commande a déjà été intégralement remboursée.',
    'MOLLIE_REFUND_REMAINING'                           => 'Rembourser la somme restante',
    'MOLLIE_VOUCHERS_EXISTING'                          => 'Cette commande comprend des coupons ou des rabais. Ceux-ci ne peuvent pas être remboursés partiellement, ils doivent être traités via le remboursement total ou restant.',
    'MOLLIE_CREDITCARD_DATA_INPUT'                      => 'Données de carte de crédit',
    'MOLLIE_CREDITCARD_DATA_INPUT_HELP'                 => 'Ce paramètre indique où le client doit saisir les informations de carte bancaire.<br>La méthode recommandée est "Saisie sur la boutique avec un formulaire Iframe".',
    'MOLLIE_CC_HOSTED_CHECKOUT'                         => 'Saisie sur le site externe Mollie',
    'MOLLIE_CC_CHECKOUT_INTEGRATION'                    => 'Saisie sur la boutique avec un formulaire Iframe',
    'MOLLIE_APPLE_PAY_BUTTON_ONLY_LIVE_MODE'            => 'Veuillez noter: Le paiement avec le bouton Apple Pay est disponible uniquement en mode Live.',
    'MOLLIE_APIKEY_CONNECTED'                           => 'Connexion réussie',
    'MOLLIE_APIKEY_DISCONNECTED'                        => 'Connexion échouée',
    'MOLLIE_ORDER_EXPIRY'                               => 'Annulation automatique après',
    'MOLLIE_ORDER_EXPIRY_DAYS'                          => 'jours',
    'MOLLIE_DEACTIVATED'                                => 'Désactivé',
    'MOLLIE_ORDER_EXPIRY_HELP'                          => 'Le module Mollie a la possibilité d\'annuler des commandes automatiquement après le délai que vous configurez ici. Ceci s\'applique aux commandes avec le statut "Statut en attente" configuré par vous.Le cronjob Mollie doit être configuré pour que cela fonctionne. Vous pouvez trouver comment configurer le cronjob dans le fichier README.md de ce module.',
    'MOLLIE_ALTLOGO_ERROR'                              => 'Il y  a eu une erreur lors du téléchargement du fichier. Veuillez vérifier les autorisations du dossier SHOPROOT/vendor/mollie/mollie-oxid7/assets/img/',
    'MOLLIE_ALTLOGO_LABEL'                              => 'Logo alternatif',
    'MOLLIE_ALTLOGO_FILENAME'                           => 'Nom de fichier',
    'MOLLIE_ALTLOGO_DELETE'                             => 'Supprimer le logo',
    'MOLLIE_SINGLE_CLICK'                               => 'Paiement en un clic activé',
    'MOLLIE_SINGLE_CLICK_HELP'                          => 'Le paiement en un clic signifie que les informations de paiement du client sont sauvegardées du côté de Mollie, pour que le client n\'ait pas besoin de les saisir à nouveau au prochain achat par carte de crédit. Ceci doit être confirmé par le client explicitement lors de l\'encaissement. Cela prend effet uniquement si le mode de données de carte de crédit est paramétré sur "Saisie sur le site externe Mollie"',
    'MOLLIE_PAYMENT_API_LINK_1'                         => 'Pour plus d\'information à propos de l\'API-Paiement (Payment-API), cliquez',
    'MOLLIE_PAYMENT_API_LINK_2'                         => 'ici',
    'MOLLIE_ORDER_API_LINK_1'                           => 'Pour plus d\'information à propos de l\'API-Commande (Order-API), cliquez',
    'MOLLIE_ORDER_API_LINK_2'                           => 'ici',
    'MOLLIE_CONNECTION_DATA'                            => 'Accédez à vos données de connexion ici:',
    'MOLLIE_ORDER_PAYMENT_URL'                          => 'Lien vers la finalisation du paiement',
    'MOLLIE_SEND_SECOND_CHANCE_MAIL'                    => 'Envoyer un email de seconde chance',
    'MOLLIE_SECOND_CHANCE_MAIL_ALREADY_SENT'            => 'L\'email a déjà été envoyé.',
    'MOLLIE_SUBSEQUENT_ORDER_COMPLETION'                => 'Achèvement de la commande ultérieure',
    'MOLLIE_PAYMENT_DESCRIPTION'                        => 'Description du paiement',
    'MOLLIE_PAYMENT_DESCRIPTION_HELP'                   => 'Ceci sera affiché à vos clients sur leurs recus de carte ou bancaires, si possible.<br><br>Vous pouveu utiliser les paramètres suivants:<br>{orderId}<br>{orderNumber}<br>{storeName}<br>{customer.firstname}<br>{customer.lastname}<br>{customer.company}',
    'MOLLIE_MODULE_VERSION_OUTDATED'                    => 'Caution! The current module version is',
    'MOLLIE_SUPPORT_HEADER'                             => 'Contact Us - Technical Support',
    'MOLLIE_SUPPORT_REQUIRED_FIELDS'                    => 'Please fill in all required fields.',
    'MOLLIE_SUPPORT_FORM_NAME'                          => 'Name',
    'MOLLIE_SUPPORT_FORM_EMAIL'                         => 'E-mail',
    'MOLLIE_SUPPORT_FORM_SUBJECT'                       => 'Subject',
    'MOLLIE_SUPPORT_FORM_ENQUIRY'                       => 'Enquiry',
    'MOLLIE_SUPPORT_FORM_ENQUIRY_PLACEHOLDER'           => 'How can we help you?',
    'MOLLIE_SUPPORT_FORM_SUBMIT'                        => 'Submit',
    'MOLLIE_SUPPORT_EMAIL_SENT'                         => 'Your support enquiry has been sent. You will receive a copy of the email.',
    'MOLLIE_PAYMENT_LIMITATION'                         => 'Mollie limitation',
    'MOLLIE_PAYMENT_LIMITATION_FROM'                    => 'From',
    'MOLLIE_PAYMENT_LIMITATION_TO'                      => 'to',
    'MOLLIE_PAYMENT_LIMITATION_UNLIMITED'               => 'unlimited',
    'MOLLIE_PAYMENT_DETAILS'                            => 'Modalités de paiement',
    'MOLLIE_PAYMENT_TYPE'                               => 'Type de paiement',
    'MOLLIE_TRANSACTION_ID'                             => 'Mollie Transaction ID',
    'MOLLIE_EXTERNAL_TRANSACTION_ID'                    => 'ID de la transaction externe',
    'MOLLIE_CAPTURE_TITLE'                              => 'Capturer les paiements',
    'MOLLIE_CAPTURE_STATUS'                             => 'Statut',
    'MOLLIE_CAPTURE_DESCRIPTION'                        => 'Montant à capturer',
    'MOLLIE_CAPTURE_AMOUNT'                             => 'Capturer montant',
    'MOLLIE_CC_CAPTURE_DIRECT'                          => 'Capturer directement les montants des cartes de crédit',
    'MOLLIE_CC_CAPTURE_AUTH'                            => 'Capturer les montants des cartes de crédit avant la capture',
    'MOLLIE_CC_CAPTURE_AUTOMATIC'                       => 'Capturer automatiquement les montants des cartes de crédit',
    'MOLLIE_CAPTURE_DAYS'                               => 'Capturer automatiquement après',
    'MOLLIE_CAPTURE_ID'                                 => 'ID Capture Mollie',
    'MOLLIE_CAPTURE_SUCCESSFUL'                         => 'Capture du montant réussi',
    'MOLLIE_CREDITCARD_CAPTURE'                         => 'Méthode de capture',
    'MOLLIE_CREDITCARD_CAPTURE_METHOD_HELP'             => 'Cette option définit quelle méthode de capture est utilisée.<br><strong>Authentifier la carte de crédit avant la capture</strong> : Le montant sera autorisé et vous devrez capturer manuellement le montant via l\'onglet Mollie dans la commande ou via le cron fourni <br><strong>Capturer directement les montants des cartes de crédit :</strong> Le montant sera directement capturé<br><strong>Capturer automatiquement les montants des cartes de crédit :</strong> Le montant sera automatiquement capturé par Mollie après X jours',
    'HELP_SHOP_MODULE_sMollieCronCaptureOrdersActive'   => 'Cette option ne fonctionne que si vous avez sélectionné <strong>Authentifier la carte de crédit avant la capture</strong> comme méthode de capture. Cette tâche cron capture les commandes qui sont exécutées et que vous auriez normalement besoin de capturer manuellement',
);
