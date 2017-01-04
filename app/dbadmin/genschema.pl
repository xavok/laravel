#!/usr/bin/perl
# generate schema json

use JSON;

open SQL, 'quansis_db.sql';

%tables = ();

sub array
{
	local @a;
	return @a;
}

while ($line = <SQL>)
{
	if ($line =~ /CREATE TABLE IF NOT EXISTS `(\w+)`/)
	{
		$tablename = $1;
		$tablesingular = substr($tablename, 0, length($tablename));
		@table = &array();
	}
	elsif ($line =~ /\s`(\w+)`\s*(\w+)\(?(\d+)?\)?/)
	{
		($fieldname, $type, $length) = ($1, $2, $3);
		local %rec;
		$rec{'name'}=$fieldname;
		$rec{'type'}=$type;
		$rec{'length'}=$length;
		if ($fieldname eq $tablesingular.'_id')
		{
			$rec{'short'} = 1;
		}
		elsif ($fieldname =~ /_id/)
		{
			#print "foreign key $fieldname\n";
			$nametrim = substr($fieldname, 0, length($fieldname)-3);
			$rec{'foreign'} = $nametrim.'s';
		}
		elsif ($fieldname =~ /name/i)
		{
			$rec{'short'} = 1;
		}
		push @table, \%rec;
	}
	elsif ($line =~ /^\)/)
	{
		#print "closing $tablename\n";
		$tables{$tablename} = decode_json(encode_json(\@table));
	}
}

close SQL;

print to_json(\%tables, { ascii => 1, pretty => 1 });

