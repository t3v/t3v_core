# --------------------------
# | T3v Core Configuration |
# --------------------------

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
      layoutRootPaths {
        0 = {$plugin.tx_t3vcore.view.layoutRootPath}
      }

      templateRootPaths {
        0 = {$plugin.tx_t3vcore.view.templateRootPath}
      }

      partialRootPaths {
        0 = {$plugin.tx_t3vcore.view.partialRootPath}
      }
    }
  }
}