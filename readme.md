# Posobota 2017 02 Model Workshop

## install

1. clone

```bash
git clone https://github.com/fprochazka/posobota-02-2017-model-workshop
```

2. create `config.local.neon`

```yml
doctrine:
	host: 127.0.0.1
	user: ???
	password: ???
	driver: pdo_pgsql
	dbname: posobota_2017_02
```

2. ???
3. profit

## implement

Vyzkoušíme si jaké to je žít v utopii a naprogramujeme si e-government blížící se ideálu.

1. Založení žádosti o živnost
	* Test, že už živnost nemá založenou
	* Komunikace s externí službou egovernment (handlování chyb)
		* Sociální
		* Zdravotní
		* Trestní rejstřík
	* Automatické ověření, že zadatel má na živnost nárok
2. Zaplacení žádosti žadatelem
	* Komunikace s platební bránou (handlování chyb)
	* Zaslání do EET
3. Schválení žádosti úředníkem
	* potvrzení lokálně
	* zaslání info o registraci plátcovství DPH na finančák
	* smazání lokální kopie dat z externích služeb
4. Výpis z rejstříku
