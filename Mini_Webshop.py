# ===== CLASS PRODUCT =====
class Product:
    def __init__(self, naam, prijs, voorraad):
        self.naam = naam
        self.prijs = prijs
        self._voorraad = voorraad

    def toon_info(self):
        print(f"{self.naam} - €{self.prijs} (voorraad: {self._voorraad})")

    def is_op_voorraad(self):
        return self._voorraad > 0

    def verlaag_voorraad(self, aantal):
        if aantal <= 0:
            print("Aantal moet groter zijn dan 0.")
            return False

        if self._voorraad >= aantal:
            self._voorraad -= aantal
            return True
        else:
            print("Niet genoeg voorraad.")
            return False


# ===== CLASS WINKELMANDJE =====
class Winkelmandje:
    def __init__(self):
        self.items = []

    def voeg_toe(self, product, aantal):
        self.items.append((product, aantal))
        print(f"Toegevoegd: {aantal} x {product.naam}")

    def toon_mandje(self):
        if not self.items:
            print("Mandje is leeg.")
            return

        print("\n--- Winkelmandje ---")
        for product, aantal in self.items:
            subtotaal = product.prijs * aantal
            print(f"{product.naam} x {aantal} = €{subtotaal}")

    def totaal_prijs(self):
        totaal = 0
        for product, aantal in self.items:
            totaal += product.prijs * aantal
        return totaal


# ===== STARTPRODUCTEN =====
producten = [
    Product("Laptop", 899, 3),
    Product("Muis", 25, 10),
    Product("Toetsenbord", 59, 5),
]

mandje = Winkelmandje()


# ===== MENU LOOP =====
while True:

    print("\n===== MINI WEBSHOP =====")
    print("1 - Producten bekijken")
    print("2 - Product toevoegen")
    print("3 - Mandje bekijken")
    print("4 - Afrekenen")
    print("0 - Stoppen")

    keuze = input("Kies een optie: ")

    # ===== PRODUCTEN TONEN =====
    if keuze == "1":
        print("\n--- Producten ---")
        for i, product in enumerate(producten):
            print(f"{i}: ", end="")
            product.toon_info()

    # ===== PRODUCT TOEVOEGEN =====
    elif keuze == "2":

        for i, product in enumerate(producten):
            print(f"{i}: ", end="")
            product.toon_info()

        try:
            index = int(input("Kies productnummer: "))
            aantal = int(input("Aantal: "))

            if index < 0 or index >= len(producten):
                print("Ongeldig productnummer.")
                continue

            if aantal <= 0:
                print("Aantal moet groter zijn dan 0.")
                continue

            product = producten[index]

            if product._voorraad < aantal:
                print("Niet genoeg voorraad.")
                continue

            mandje.voeg_toe(product, aantal)

        except ValueError:
            print("Voer een geldig nummer in.")

    # ===== MANDJE TONEN =====
    elif keuze == "3":
        mandje.toon_mandje()
        print(f"Totaal: €{mandje.totaal_prijs()}")

    # ===== AFREKENEN =====
    elif keuze == "4":

        if not mandje.items:
            print("Mandje is leeg.")
            continue

        totaal = mandje.totaal_prijs()

        print("\n--- Afrekenen ---")

        for product, aantal in mandje.items:
            if not product.verlaag_voorraad(aantal):
                print("Afrekenen mislukt door voorraadprobleem.")
                break
        else:
            korting = 0

            if totaal > 500:
                korting = totaal * 0.10
                print(f"Korting toegepast: €{korting}")

            eindprijs = totaal - korting

            print(f"Totaal: €{totaal}")
            print(f"Eindbedrag: €{eindprijs}")
            print("Bedankt voor je aankoop!")

            mandje.items = []

    # ===== STOP =====
    elif keuze == "0":
        print("Programma gestopt.")
        break

    else:
        print("Ongeldige keuze.")