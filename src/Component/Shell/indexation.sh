echo "Indexation shell script hase been launched"
#sudo php bin/console stats:person:update
echo "Stats have be generated"
#sudo php bin/console elastic:populate
echo "Elastic Search indexes have been updated"
#sudo php bin/console algolia:populate
echo "Algolia index has been updated"
cd ../../../
ls