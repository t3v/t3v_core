# --------------------------
# | T3v Core Configuration |
# --------------------------

# === Plugin Configuration ===

plugin {
  tx_t3vcore {
    persistence {
      enableAutomaticCacheClearing = {$plugin.tx_t3vcore.persistence.enableAutomaticCacheClearing}

      storagePid = {$plugin.tx_t3vcore.persistence.storagePid}

      updateReferenceIndex = {$plugin.tx_t3vcore.persistence.updateReferenceIndex}
    }

    settings {
      # ...
    }

    view {
      layoutRootPath = {$plugin.tx_t3vcore.view.layoutRootPath}

      layoutRootPaths {
        0 = {$plugin.tx_t3vcore.view.layoutRootPath}
      }

      templateRootPath = {$plugin.tx_t3vcore.view.templateRootPath}

      templateRootPaths {
        0 = {$plugin.tx_t3vcore.view.templateRootPath}
      }

      partialRootPath = {$plugin.tx_t3vcore.view.partialRootPath}

      partialRootPaths {
        0 = {$plugin.tx_t3vcore.view.partialRootPath}
      }
    }
  }
}