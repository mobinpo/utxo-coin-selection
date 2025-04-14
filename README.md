# Coin Selection Algorithm for UTXO-Based Blockchains

## Overview
This repository contains the source code, documentation, and research paper for a fast and adaptive coin selection algorithm designed for UTXO-based blockchains like Bitcoin.

The algorithm was developed and implemented by **Mobin Poursalami** as part of the internal architecture for the **Xapa** digital wallet. It is optimized for speed, fee reduction, and low fragmentation, using an adaptive random sampling method.

---

## Features
- Fast selection for large UTXO sets
- Reduces transaction fees and fragmentation
- Uses randomized + adaptive logic
- Implemented in real-world use case (Xapa Wallet)

---

## Folder Structure
```
.
├── pdf/               # Final secure PDF version of the paper
├── src/               # Source code (PHP, pseudocode, Python-like version)
├── docs/              # HTML version of the paper for online viewing
├── LICENSE            # Protection and author declaration
└── README.md          # This file
```

---

## Quick Start

```bash
# Clone the repo
$ git clone https://github.com/mobinpo/utxo-coin-selection.git

# Explore pseudocode or integrate into your wallet logic
cd utxo-coin-selection/src
```

---

## Citation
If you use or build upon this work, please cite:

> Mobin Poursalami. "A Fast and Adaptive Coin Selection Algorithm for UTXO-Based Blockchains." (2024).

---

## Contact
- **Author**: Mobin Poursalami  
- **Email**: mobinpou@gmail.com  
- **LinkedIn**: [linkedin.com/in/mobin-poursalami-8528ba202](https://linkedin.com/in/mobin-poursalami-8528ba202)
- **GitHub**: [github.com/mobinpo](https://github.com/mobinpo)

---

## License
This project and all its contents are authored and protected by Mobin Poursalami. Redistribution or reuse must be approved by the author. All rights reserved.
